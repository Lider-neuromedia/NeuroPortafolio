<?php

namespace App\Http\Controllers;

use App\Category;
use App\Link;
use App\Project;

class ProjectsController extends Controller
{
    public function index(String $link)
    {
        $result = Category::whereSlug($link)->first();

        if (!$result) {
            $result = Link::whereSlug($link)->first();
        }
        if (!$result) {
            return abort(404);
        }

        return view('showcase', compact('result'));
    }

    public function show(String $project)
    {
        $project = Project::whereSlug($project)->firstOrFail();
        return view('project', compact('project'));
    }
}
