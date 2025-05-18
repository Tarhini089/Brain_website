<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <!-- List of Customers -->
        <table class="w-full table-auto border mb-8">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Phone</th>
                    <th class="border px-4 py-2">Country</th>
                    <th class="border px-4 py-2">City</th>
                    <th class="border px-4 py-2">District</th>
                    <th class="border px-4 py-2">Zone</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                    <th class="border px-4 py-2">Actions-2</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td class="border px-4 py-2">{{ $customer->id }}</td>
                        <td class="border px-4 py-2">{{ $customer->name }}</td>
                        <td class="border px-4 py-2">{{ $customer->email }}</td>
                        <td class="border px-4 py-2">{{ $customer->phone }}</td>
                        <td class="border px-4 py-2">{{ $customer->country->name ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $customer->city->name ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $customer->district->name ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $customer->zone->name ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $customer->isinactive ? 'Inactive' : 'Active' }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add Customer -->
        <form action="{{ route('customers.store') }}" method="POST" class="mb-6 space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="country_id" class="block text-sm font-medium text-gray-700">Country</label>
                <select name="country_id" id="country_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="city_id" class="block text-sm font-medium text-gray-700">City</label>
                <select name="city_id" id="city_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    <option value="">Select City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="district_id" class="block text-sm font-medium text-gray-700">District</label>
                <select name="district_id" id="district_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    <option value="">Select District</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="zone_id" class="block text-sm font-medium text-gray-700">Zone</label>
                <select name="zone_id" id="zone_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    <option value="">Select Zone</option>
                    @foreach($zones as $zone)
                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="isinactive" id="isinactive" class="mr-2">
                <label for="isinactive" class="text-sm text-gray-700">Inactive</label>
            </div>
            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">Add Customer</button>
        </form>
    </div>
</x-app-layout>
