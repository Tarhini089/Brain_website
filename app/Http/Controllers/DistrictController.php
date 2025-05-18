<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::all();
        return view('districts.index', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        District::create([
            'name' => $request->name,
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('districts.index')->with('success', 'District added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $district = District::findOrFail($id);
        $district->update([
            'name' => $request->name,
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('districts.index')->with('success', 'District updated successfully.');
    }

    public function destroy($id)
    {
        Log::info("Deleting District: " . $id);

        $district = District::findOrFail($id);
        $district->delete();

        return redirect()->route('districts.index')->with('success', 'District deleted successfully.');
    }
}
