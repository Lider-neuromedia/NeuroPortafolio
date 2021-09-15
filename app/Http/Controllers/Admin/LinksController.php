<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('s');
        $links = Link::query()
            ->when($search, function ($q) use ($search) {
                $q->where('slug', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(session('paginate') ?: 20);
        return view('admin.links.index', compact('links', 'search'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Link $link)
    {
        //
    }

    public function edit(Link $link)
    {
        //
    }

    public function update(Request $request, Link $link)
    {
        //
    }

    public function destroy(Link $link)
    {
        $link->delete();
        session()->flash('message', "Registro borrado.");
        return redirect()->back();
    }
}
