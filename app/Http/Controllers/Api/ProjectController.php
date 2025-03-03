<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $projects = Auth::user()->projects;

        return $this->returnData($projects);
    }

    public function show($projectId)
    {
        $project = auth()->user()->projects()->find($projectId);

        if (!$project) {
            return response()->json(['message' => 'Project not found.'], 404);
        }

        return $this->returnData($project);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = auth()->user()->projects()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $this->returnData($project, "Project created successfully.");
    }


    public function update(Request $request, $projectId)
    {
        $project = auth()->user()->projects()->find($projectId);

        if (!$project) {
            return $this->returnData([], 'Project not found.', 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $this->returnData($project, "Project updated successfully.");
    }

    public function destroy($projectId)
    {
        $project = auth()->user()->projects()->find($projectId);

        if (!$project) {
            return $this->returnData([], "Project not found.", 404);
        }
        $project->delete();

        return $this->returnData([], "Project updated successfully.");
    }
}
