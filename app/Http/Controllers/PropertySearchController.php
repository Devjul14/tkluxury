<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertySearchController extends Controller
{
    public function index()
    {
        $institutes = Institute::orderBy('name')->get();
        return view('properties.search', compact('institutes'));
    }

    public function results(Request $request)
    {
        $request->validate([
            'institute_id' => 'required|exists:institutes,id',
            'radius' => 'nullable|integer|min:100',
        ]);

        $radius = $request->input('radius', 5000); // default 5 km
        $properties = Property::nearbyInstitute($request->institute_id, $radius)->get();

        $institute = Institute::find($request->institute_id);

        return view('properties.results', compact('properties', 'institute', 'radius'));
    }
}
