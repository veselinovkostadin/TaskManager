@extends('layouts.app')

@section('title', 'Overview - Platform Dashboard')

@section('custom-content')
<div class="p-6 text-black flex w-full h-screen text-center">
    <div class="mb-8">
        <h2 class="text-3xl font-semibold text-gray-800">Welcome Back, {{ Auth::user()->name }}!</h2>
        <p class="text-lg text-gray-600 mt-2">This is your overview page where you can manage your projects and tasks!</p>
    </div>

</div>

@endsection
