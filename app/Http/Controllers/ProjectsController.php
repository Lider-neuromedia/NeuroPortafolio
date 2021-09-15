<?php

namespace App\Http\Controllers;

use App\Link;
use App\Project;

class ProjectsController extends Controller
{
    public function index(String $link)
    {
        $result = Link::whereSlug($link)->first();

        if (!$result) {
            return abort(404);
        }

        return view('showcase', compact('result'));
    }

    public function show(String $link, String $project)
    {
        $link = Link::whereSlug($link)->first();

        if (!$link) {
            return abort(404);
        }

        $project = $link->projects()
            ->whereSlug($project)
            ->firstOrFail();

        return view('project', compact('project'));
    }

    public function project(String $project)
    {
        $project = Project::whereSlug($project)->firstOrFail();
        return view('project', compact('project'));
    }
}
