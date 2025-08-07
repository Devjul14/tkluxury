<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Property;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::query()
            ->with(['images', 'rooms'])
            ->where('is_active', true);
        $institutes = Institute::query()->get();
        $perPage = config('hostel.rooms.per_page', 12);

        if ($request->filled('institute')) {
            $properties->where('institute_id', $request->institute);
        }
        if ($request->filled('room_count')) {
            $properties->has('rooms', '>=', (int) $request->room_count);
        }

        $propertycollection = $properties->get();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedProperties = new LengthAwarePaginator(
            $propertycollection->forPage($currentPage, $perPage)->values(),
            $propertycollection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        $propertyRoomCounts = $propertycollection->mapWithKeys(function ($property) {
            return [$property->id => $property->rooms->count()];
        });

        return view('properties.index', [
            'properties' => $propertycollection,
            'institutes' => $institutes,
            'pagedProperties' => $pagedProperties,
            'propertyRoomCounts' => $propertyRoomCounts->unique(),
        ]);
    }

    public function show(Property $property)
    {
        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('title', 'asc')
            ->get();

        $relatedRooms = $property->rooms()->get();
        return view('properties.show', compact('property', 'services', 'relatedRooms'));
    }

    public function rooms(Property $property)
    {
        $rooms = $property->rooms()->get();

        return view('properties.rooms', compact('property', 'rooms'));
    }
}
