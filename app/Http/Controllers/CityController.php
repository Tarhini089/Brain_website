<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request; // ✅ this is correct
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
   
    public function index(Request $request)
    {
        $query = City::query();

        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $cities = $query->get();

        return view('cities.index', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        City::create([
            'name' => $request->name,
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('cities.index')->with('success', 'City added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $city = City::findOrFail($id);
        $city->update([
            'name' => $request->name,
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('cities.index')->with('success', 'City updated successfully.');
    }

    public function destroy($id)
    {
        Log::info("Deleting city: " . $id);

        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('cities.index')->with('success', 'City deleted successfully.');
    }
}