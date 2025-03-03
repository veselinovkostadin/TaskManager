<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $tasks = $project->tasks()->orderBy("due_date")->get();
        return view("tasks.index", compact("project", "tasks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view("tasks.create", compact("project"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, Project $project)
    {
        $project->tasks()->create([
            "title" => $request->title,
            "description" => $request->description,
            "due_date" => $request->due_date,
            "project_id" => $project->id
        ]);

        return redirect()->route("tasks.index", $project)->with('success', 'Task created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view("tasks.edit", compact("task"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->only(['title', "description", "due_date"]));

        return redirect()->route("tasks.index", $task->project)->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $project = $task->project;
        $task->delete();

        return redirect()->route("tasks.index", $project)->with('success', 'Task deleted successfully.');
    }
}
