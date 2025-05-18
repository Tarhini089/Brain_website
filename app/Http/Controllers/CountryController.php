<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Country::create([
            'name' => $request->input('name'),
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('countries.index')->with('success', 'Country added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $country = Country::findOrFail($id);
        $country->update([
            'name' => $request->input('name'),
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
    }
}
