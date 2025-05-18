{{-- resources/views/customers/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Customer
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-4xl mx-auto bg-white shadow rounded">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $customer->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $customer->email) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $customer->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $customer->address) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="country_id" class="block text-sm font-medium text-gray-700">Country</label>
                    <select name="country_id" id="country_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ $customer->country_id == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="city_id" class="block text-sm font-medium text-gray-700">City</label>
                    <select name="city_id" id="city_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $customer->city_id == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="district_id" class="block text-sm font-medium text-gray-700">District</label>
                    <select name="district_id" id="district_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select District</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" {{ $customer->district_id == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="zone_id" class="block text-sm font-medium text-gray-700">Zone</label>
                    <select name="zone_id" id="zone_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Zone</option>
                        @foreach($zones as $zone)
                            <option value="{{ $zone->id }}" {{ $customer->zone_id == $zone->id ? 'selected' : '' }}>
                                {{ $zone->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="isinactive" id="isinactive" {{ $customer->isinactive ? 'checked' : '' }} class="mr-2">
                <label for="isinactive" class="text-sm text-gray-700">Inactive</label>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-black px-6 py-2 rounded-md">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
