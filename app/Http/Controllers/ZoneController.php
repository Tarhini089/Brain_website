<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::all();
        return view('zones.index', compact('zones'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Zone::create([
            'name' => $request->name,
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('zones.index')->with('success', 'Zone added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $zone = Zone::findOrFail($id);
        $zone->update([
            'name' => $request->name,
            'isinactive' => $request->has('isinactive'),
        ]);

        return redirect()->route('zones.index')->with('success', 'Zone updated successfully.');
    }

    public function destroy($id)
    {
        Log::info("Deleting Zone: " . $id);

        $Zone = Zone::findOrFail($id);
        $Zone->delete();

        return redirect()->route('zones.index')->with('success', 'Zone deleted successfully.');
    }
}