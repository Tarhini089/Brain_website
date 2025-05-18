<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content and Sidebar -->
    <div x-data="{ open: false, showCountryModal: false }" class="flex min-h-screen">
        <!-- Sidebar -->
        <div x-show="open" class="w-48 bg-white dark:bg-gray-800 text-gray-800 dark:text-white p-4 shadow flex flex-col justify-start">
            <!-- Toggle Button (Inside Panel at Top) -->
            <button @click="open = false" class="mb-4 self-end text-gray-700 dark:text-gray-300 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Navigation Buttons -->
            <a href="{{ route('countries.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                Country
            </a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">City</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">District</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Zone</a>
        </div>

        <!-- Re-open Button when Sidebar is Closed -->
        <div x-show="!open" class="p-2">
            <button @click="open = true" class="text-gray-700 dark:text-gray-300 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Main Content -->
        <main class="flex-0.4 px-0 py-0">
                {{ $slot }}
        </main>

        <!-- Country Modal -->
        <div x-show="showCountryModal"
     class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 p-4"
     x-cloak>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Add Country</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('countries.store') }}" class="space-y-6">
    @csrf

    <div>
        <x-input-label for="name" :value="__('Country Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                      placeholder="Country name" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="flex items-center">
        <input id="inactive" name="inactive" type="checkbox"
               class="mr-2 border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
        <label for="inactive" class="text-sm text-gray-700 dark:text-gray-300">
            {{ __('Is Inactive') }}
        </label>
    </div>

    <div class="flex justify-end gap-2">
        <button type="button" @click="showCountryModal = false"
                class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-500">
            {{ __('Cancel') }}
        </button>

        <x-primary-button>
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>
    </div>
</div>
    </div>
</div>
</body>
</html>
