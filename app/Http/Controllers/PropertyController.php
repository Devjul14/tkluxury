<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Property;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
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

        if ($request->filled('check_in') && $request->filled('check_out')) {
            session()->put('check_in_filter', $request->check_in);
            session()->put('check_out_filter', $request->check_out);

            $properties->whereHas('rooms', function ($query) use ($request) {
                $query->whereDoesntHave('bookings', function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q
                            ->where('check_in_date', '<', $request->check_out)
                            ->where('check_out_date', '>', $request->check_in);
                    });
                });
            });
        }

        if ($request->filled('student')) {
            $properties->whereHas('rooms', function ($query) use ($request) {
                $query->where('capacity', '>=', $request->student);
            });
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
            'properties' => $pagedProperties,
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
