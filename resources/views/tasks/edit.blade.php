@extends('layouts.app')

@section('title', 'Edit Task')

@section('custom-content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-blue-900 mb-4">Edit Task</h1>

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

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4 text-black">
                <label for="title" class="block text-sm mb-2 font-semibold text-blue-900">Task Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mb-4 text-black">
                <label for="description" class="block text-sm mb-2 font-semibold text-blue-900">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded-lg" required>{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-4 text-black">
                <label for="date" class="block text-sm mb-2 font-semibold text-blue-900">Due Date</label>
                <input type="date" name="due_date" id="date" value="{{ old('due_date', $task->due_date) }}" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('tasks.index',$task->project) }}" class="text-sm text-blue-900 hover:text-blue-700">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection