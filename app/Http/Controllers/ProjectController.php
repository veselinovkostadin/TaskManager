<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->load("projects")->projects()->orderBy('created_at', 'desc')->get();

        return view("projects.index", compact("projects"));
    }

    public function create()
    {
        return view("projects.create");
    }

    public function store(StoreProject $request)
    {
        Project::create([
            "name" => $request->name,
            "description" => $request->description,
            "user_id" => Auth::user()->id,
        ]);

        return redirect()->route("projects.index")->with('success', 'Project created successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route("projects.index")->with('success', 'Project deleted successfully.');
    }

    public function edit(Project $project)
    {
        return view("projects.edit", compact("project"));
    }

    public function update(StoreProject $request, Project $project)
    {
        $project->update($request->only(["name", "description"]));

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }
}
