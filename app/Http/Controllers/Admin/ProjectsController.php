<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Project;
use App\ProjectAsset;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    const VIDEOS_COUNT = 3;
    const IMAGES_COUNT = 5;

    public function index(Request $request)
    {
        $search = $request->get('s') ?: "";
        $category = $request->get('c') ?: "";
        $categories = Category::orderBy('name', 'asc')->get()->map(function ($c) {
            $c->count_projects = $c->projects()->count();
            return $c;
        });

        $projects = Project::query()
            ->when($search, function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%");
            })
            ->when($category, function ($q) use ($category) {
                $q->whereHas('categories', function ($q) use ($category) {
                    $q->where('categories.id', $category);
                });
            })
            ->paginate(9);

        return view('admin.projects.index', compact('projects', 'categories', 'search', 'category'));
    }

    public function create()
    {
        $project = new Project();
        $categories = Category::all();
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
        $categories = Category::all();
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
        //
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

            return redirect()
                ->back()
                ->withInput($request->input());
        }
    }
}
