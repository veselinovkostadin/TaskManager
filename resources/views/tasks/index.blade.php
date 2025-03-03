@extends('layouts.app')

@section('title', 'Manage Tasks')

@section('custom-content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('projects.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Back
        </a>
        <h1 class="text-2xl font-bold text-blue-900">Manage Tasks for {{ $project->name }} </h1>
        <a href="{{ route('tasks.create',$project) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Add Task
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 text-blue-900">
                    <th class="p-3 border">Task title</th>
                    <th class="p-3 border">Task description</th>
                    <th class="p-3 border">Task due</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="border-b text-black">
                    <td class="p-3 border">{{ $task->title }}</td>
                    <td class="p-3 border">{{ $task->description }}</td>
                    <td class="p-3 border">{{ $task->due_date }}</td>

                    <td class="p-3 border space-x-2">
                
                        <a href="{{  route('tasks.edit', $task) }}" 
                            class="bg-blue-200 text-blue-700 px-4 py-2 rounded hover:bg-blue-300 transition duration-300">
                             Edit
                         </a>
                         
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-200 text-red-700 px-4 py-2 rounded hover:bg-red-300 transition duration-300">
                                Delete
                            </button>
                            
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection