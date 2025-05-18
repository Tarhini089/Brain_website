<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Country;
use App\Models\City;
use App\Models\District;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with(['country', 'city', 'district', 'zone'])->get();
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();
        $zones = Zone::all();

    return view('customers.index', compact('customers', 'countries', 'cities', 'districts', 'zones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();
        $zones = Zone::all();

        return view('customers.create', compact('countries', 'cities', 'districts', 'zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'zone_id' => 'nullable|exists:zones,id',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'zone_id' => $request->zone_id,
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::with(['country', 'city', 'district', 'zone'])->findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();
        $zones = Zone::all();

        return view('customers.edit', compact('customer', 'countries', 'cities', 'districts', 'zones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'zone_id' => 'nullable|exists:zones,id',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'zone_id' => $request->zone_id,
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}