<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class TaskController extends Controller
{
    use ApiResponse;

    public function index($projectId)
    {
        $project = Project::where('id', $projectId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$project) {
            return $this->returnData([], 'Project not found or unauthorized.', 404);
        }

        $tasks = $project->tasks;

        return $this->returnData($tasks);
    }

    public function show($taskId, $projectId)
    {
        $project = Project::where('id', $projectId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$project) {
            return $this->returnData([], 'Project not found or unauthorized.', 403);
        }

        $task = Task::where('id', $taskId)
            ->where('project_id', $projectId)
            ->first();

        if (!$task) {
            return $this->returnData([], 'Task not found.', 404);
        }

        return $this->returnData($task);
    }

    public function store(Request $request, $projectId)
    {
        $project = Project::where('id', $projectId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$project) {
            return $this->returnData([], 'Project not found or unauthorized.', 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'project_id' => $project->id,
        ]);

        return $this->returnData($task, 'Task created successfully.', 201);
    }

    public function update(Request $request, $taskId)
    {

        $task = Task::find($taskId);

        if (!$task) {
            return $this->returnData([], 'Task not found.', 404);
        }

        // Ensure the task belongs to a project that the user owns
        $project = Project::where('id', $task->project_id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$project) {
            return $this->returnData([], 'Unaouthorized', 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return $this->returnData($task, 'Task updated successfully', 200);
    }

    public function destroy($taskId)
    {
        $task = Task::find($taskId);

        if (!$task) {
            return $this->returnData([], 'Task not found.', 404);
        }

        $project = Project::where('id', $task->project_id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$project) {
            return $this->returnData([], 'Unaouthorized', 403);
        }

        $task->delete();

        return $this->returnData($task, "Task deleted successfully.", 200);
    }
}
