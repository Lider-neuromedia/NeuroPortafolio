<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Http\Requests\ProjectRequest;
use App\Link;
use App\Project;
use App\ProjectAsset;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    const VIDEOS_COUNT = 3;
    const IMAGES_COUNT = 5;

    public function index(Request $request)
    {
        $create_link = $request->get('create-link') == 1 ? 1 : "";
        $link_projects = [];

        if (session('link.projects')) {
            $link_projects = Project::query()
                ->whereIn('id', session('link.projects'))
                ->orderBy('title', 'asc')
                ->get();
        }

        $search = $request->get('s') ?: "";
        $category = $request->get('c') ?: "";
        $categories = Category::orderBy('name', 'asc')->get()->map(function ($c) {
            $c->count_projects = $c->projects()->count();
            return $c;
        });

        $projects = Project::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                });
            })
            ->when($category, function ($q) use ($category) {
                $q->whereHas('categories', function ($q) use ($category) {
                    $q->where('categories.id', $category);
                });
            })
            ->paginate(9);

        return view('admin.projects.index', compact('projects', 'categories', 'search', 'category', 'create_link', 'link_projects'));
    }

    public function create()
    {
        $project = new Project();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.projects.create', compact('project', 'categories'))->with([
            'videos_count' => self::VIDEOS_COUNT,
            'images_count' => self::IMAGES_COUNT,
        ]);
    }

    public function store(ProjectRequest $request)
    {
        return $this->saveOrUpdate($request);
    }

    public function edit(Project $project)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.projects.edit', compact('project', 'categories'))->with([
            'videos_count' => self::VIDEOS_COUNT,
            'images_count' => self::IMAGES_COUNT,
        ]);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        return $this->saveOrUpdate($request, $project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        session()->flash('message', "Registro borrado.");
        return redirect()->action('Admin\ProjectsController@index');
    }

    private function saveOrUpdate(Request $request, Project $project = null)
    {
        try {

            \DB::beginTransaction();

            $data = $request->only('title', 'description');

            if ($project != null) {
                $project->update($data);
            } else {
                $project = Project::create($data);
                $project->save();
            }

            // Categorías
            $project->categories()->sync($request->get('categories'));

            // Logo
            if ($request->hasFile('logo')) {
                $project->assets()->where('type', ProjectAsset::LOGO_ASSET)->delete();
                $logo_path = $request->file('logo')->store('public/projects');
                $logo_path = array_reverse(explode('/', $logo_path))[0];
                $project->saveLogo($logo_path);
            }

            // Videos
            $project->assets()->where('type', ProjectAsset::VIDEO_ASSET)->delete();

            foreach ($request->get('videos') as $video_path) {
                if ($video_path != null) {
                    $project->saveVideo($video_path);
                }
            }

            // Imagenes

            if ($request->hasFile('images')) {
                $current_images = $request->get('current_images');

                foreach ($request->file('images') as $key => $file) {
                    $image_path = $file->store('public/projects');
                    $image_path = array_reverse(explode('/', $image_path))[0];
                    $current_images[$key] = $image_path;
                }

                $project->assets()->where('type', ProjectAsset::IMAGE_ASSET)->delete();

                foreach ($current_images as $image_path) {
                    if ($image_path != null) {
                        $project->saveImage($image_path);
                    }
                }
            }

            \DB::commit();

            session()->flash('message', "Registro guardado correctamente.");
            return redirect()->action('Admin\ProjectsController@edit', $project->id);

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al guardar registro.");
            return redirect()->back()->withInput($request->input());
        }
    }

    public function addProjectToLink(Request $request, Project $project)
    {
        $links = session('link.projects');
        $links[] = $project->id;
        $request->session()->put('link.projects', array_unique($links));
        session()->flash('message', "Proyecto agregado al enlace.");

        return redirect()->back();
    }

    public function removeProjectFromLink(Request $request, Project $project)
    {
        $links = collect(session('link.projects'))
            ->filter(function ($value, $key) use ($project) {
                return $value != $project->id;
            })
            ->toArray();

        $request->session()->put('link.projects', array_unique($links));
        session()->flash('message', "Proyecto quitado del enlace.");

        return redirect()->back();
    }

    public function cancelLinkCreation(Request $request)
    {
        $request->session()->forget('link.projects');
        session()->flash('message', "Creación de enlace cancelada.");
        return redirect()->action('Admin\ProjectsController@index');
    }

    public function createLink(LinkRequest $request)
    {
        try {

            \DB::beginTransaction();

            $link = new Link([
                'slug' => \Str::slug($request->get('slug')),
            ]);
            $link->save();

            $projects = Project::query()
                ->whereIn('id', session('link.projects'))
                ->orderBy('title', 'asc')
                ->get();

            $link->projects()->sync($projects);

            \DB::commit();

            $request->session()->forget('link.projects');
            session()->flash('message', "Registro guardado correctamente.");

            return redirect()->action('Admin\ProjectsController@index');

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al guardar registro.");
            return redirect()->back()->withInput($request->input());
        }
    }
}
