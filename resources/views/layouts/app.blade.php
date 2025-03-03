@extends('layouts.main')

@section('title', 'Admin Panel')

@section('content')
<div class="flex h-screen relative">

    <button id="sidebarToggle" class="absolute top-4 left-4 md:hidden bg-blue-500 text-white p-2 rounded">
        ☰ Menu
    </button>

    <aside id="sidebar" class="w-64 bg-pink-100 text-blue-900 flex flex-col fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 overflow-y-auto">
        <div class="flex-1 p-4">

            <div class="mb-4">
                <h3 class="text-lg font-bold mb-2">Resources:</h3>
                <div class="mb-4">
                    <a href="{{route('projects.index')}}" class="block py-2 px-4 hover:bg-gray-600 rounded text-sm  {{ request()->routeIs('projects.index') ? 'bg-gray-700 text-white' : 'text-blue-900' }}">
                        • Manage Projects
                    </a>
                </div>

            </div>

            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="flex items-center py-2 px-3 mb-2 w-full text-left bg-red-600 hover:bg-red-500 rounded text-sm text-white">
                    <span>Logout</span>
                </button>
            </form>
            

            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>

        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 bg-gradient-to-r from-white via-green-100 to-green-100  text-black overflow-auto md:ml-64">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white bg-opacity-10 shadow-sm sm:rounded-lg">
                <div class="text-gray-100">
                    @yield('custom-content')
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Sidebar Toggle Script -->
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });
</script>

@endsection