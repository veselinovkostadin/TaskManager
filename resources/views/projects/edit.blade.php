@extends('layouts.app')

@section('title', 'Edit Project')

@section('custom-content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-blue-900 mb-4">Edit Project</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4 rounded">
                <strong>Whoops! Something went wrong.</strong>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4 text-black">
                <label for="name" class="block text-sm mb-2 font-semibold text-blue-900">Project name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mb-4 text-black">
                <label for="description" class="block text-sm mb-2 font-semibold text-blue-900">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded-lg" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('projects.index') }}" class="text-sm text-blue-900 hover:text-blue-700">Back to all projects</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
