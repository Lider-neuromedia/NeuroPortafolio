<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index()
    {
        $links = Link::paginate(15);
        return view('admin.links.index', compact('links'));
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
