@extends('layouts.app')

@section('title', 'Create Task')

@section('custom-content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-blue-900 mb-4">Create New Task</h1>

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

        <form action="{{ route('tasks.store',$project) }}" method="POST">
            @csrf
            <div class="mb-4 text-black">
                <label for="title" class="block text-sm mb-2 font-semibold text-blue-900">Task Name</label>
                <input type="text" name="title" id="title" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mb-4 text-black">
                <label for="description" class="block text-sm mb-2 font-semibold text-blue-900">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded-lg" required></textarea>
            </div>

            <div class="mb-4 text-black">
                <label for="date" class="block text-sm mb-2 font-semibold text-blue-900">Due Date</label>
                <input type="date" name="due_date" id="date" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('tasks.index',$project) }}" class="text-sm text-blue-900 hover:text-blue-700">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
