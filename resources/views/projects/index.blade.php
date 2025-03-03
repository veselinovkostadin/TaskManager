@extends('layouts.app')

@section('title', 'Manage Projects')

@section('custom-content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-blue-900">Manage Projects</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Add Project
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-200 text-blue-900">
                <th class="p-3 border">Project name</th>
                <th class="p-3 border">Project description</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr class="border-b text-black">
                <td class="p-3 border">{{ $project->name }}</td>
                <td class="p-3 border truncate max-w-xs" style="max-width: 250px;">{{ $project->description }}</td>
   

                    <td class="p-3 border space-x-2">
                        <a href="{{ route('tasks.index', $project) }}" 
                            class="bg-blue-200 text-blue-700 px-4 py-2 rounded hover:bg-blue-300 transition duration-300">
                             Manage tasks
                         </a>
    
                        <a href="{{ route('projects.edit', $project) }}" 
                            class="bg-blue-200 text-blue-700 px-4 py-2 rounded hover:bg-blue-300 transition duration-300">
                             Edit
                         </a>
                         
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
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

@endsection