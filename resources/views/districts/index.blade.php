<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('districts') }}
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <!-- List of Districts (moved before the form) -->
        <table class="w-full table-auto border mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($districts as $district)
                <tr>
                    <td class="border px-4 py-2">{{ $district->id }}</td>

                    <!-- Update Form -->
                    <td class="border px-4 py-2">
                        <form action="{{ route('districts.update', $district->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $district->name }}" class="rounded border px-2 py-1 w-40">
                    </td>
                    <td class="border px-4 py-2">
                            <input type="checkbox" name="isinactive" {{ $district->isinactive ? 'checked' : '' }}>
                    </td>
                    <td class="border px-4 py-2 flex space-x-2">
                            <button type="submit" class="bg-green-600 text-black px-3 py-1 rounded">Update</button>
                        </form> <!-- Close update form BEFORE delete form -->

                        <!-- Delete Form -->
                        <form action="{{ route('districts.destroy', $district->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-black px-3 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add District (moved after the table) -->
        <form action="{{ route('districts.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">District Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="isinactive" id="isinactive" class="mr-2">
                <label for="isinactive" class="text-sm text-gray-700">Inactive</label>
            </div>
            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">Add District</button>
        </form>
    </div>
</x-app-layout>
