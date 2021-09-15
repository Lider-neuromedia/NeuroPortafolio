<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('s');
        $categories = Category::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(session('paginate') ?: 20);
        return view('admin.categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        $category = new Category();
        return view('admin.categories.create', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        return $this->saveOrUpdate($request);
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        return $this->saveOrUpdate($request, $category);
    }

    public function destroy(Category $category)
    {
        if ($category->projects()->count() > 0) {
            session()->flash('message-error', "El registro no puede ser borrado.");
            return redirect()->back();
        }

        $category->delete();
        session()->flash('message', "Registro borrado.");
        return redirect()->action('Admin\CategoriesController@index');
    }

    private function saveOrUpdate(Request $request, Category $category = null)
    {
        try {

            \DB::beginTransaction();

            $data = $request->only('name');
            $data['slug'] = \Str::slug($request->get('name'));

            if ($category != null) {
                $category->update($data);
            } else {
                $category = Category::create($data);
                $category->save();
            }

            \DB::commit();

            session()->flash('message', "Registro guardado correctamente.");
            return redirect()->action('Admin\CategoriesController@edit', $category->id);

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al guardar registro.");
            return redirect()->back()->withInput($request->input());
        }
    }
}
