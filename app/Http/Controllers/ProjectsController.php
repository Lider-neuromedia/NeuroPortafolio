<?php

namespace App\Http\Controllers;

use App\Link;
use App\Project;

class ProjectsController extends Controller
{
    public function index(Link $link)
    {
        return view('showcase', compact('link'));
    }

    public function show(Project $project)
    {
        return view('project', compact('project'));
    }
}
