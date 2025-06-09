@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Quick Actions</h2>
            <div class="space-y-3">
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('users.create') }}" class="block w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add New User
                </a>
                @endif
                <a href="{{ route('users.index') }}" class="block w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    View All Users
                </a>
            </div>
        </div>

        <!-- Statistics -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Statistics</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Total Users</span>
                    <span class="text-lg font-semibold">{{ \App\Models\User::count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Admin Users</span>
                    <span class="text-lg font-semibold">{{ \App\Models\User::where('role', 'admin')->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
