@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow-md rounded px-8 py-6 w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Please log in to continue</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" required
                    class="mt-1 block w-full px-3 py-2 border rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter your email">
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full px-3 py-2 border rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter your password">
            </div>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="text-sm text-red-500">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md text-sm font-medium hover:bg-indigo-700">
                Log in
            </button>
        </form>
    </div>
</div>
@endsection
