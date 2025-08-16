<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Review;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Sample featured rooms data
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $properties = Property::query()
            ->with(['images', 'rooms'])
            ->where('is_active', true);

        if ($request->filled('institute')) {
            $properties->where('institute_id', $request->institute);
        }

        if ($request->filled('room_count')) {
            $properties->has('rooms', '>=', (int) $request->room_count);
        }

        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkInCarbon = Carbon::createFromFormat('m.d.Y', $request->check_in);
            $checkOutCarbon = Carbon::createFromFormat('m.d.Y', $request->check_out);

            session()->put('check_in_filter', $request->check_in);
            session()->put('check_out_filter', $request->check_out);

            $properties->whereDoesntHave('bookings', function ($query) use ($checkInCarbon, $checkOutCarbon) {
                $query->where(function ($q) use ($checkInCarbon, $checkOutCarbon) {
                    $q
                        ->where('check_in_date', '<', $checkOutCarbon)
                        ->where('check_out_date', '>', $checkInCarbon);
                });
            });
        }

        if ($request->filled('student')) {
            $properties->whereHas('rooms', function ($query) use ($request) {
                $query->where('capacity', '>=', $request->student);
            });
        }

        $properties = $properties->get();

        $featuredRooms = Room::whereIn('property_id', $properties->pluck('id')->toArray())->get();

        $roomPromo = $featuredRooms->count() > 0 ? $featuredRooms->random() : null;
        $galleryImages = Cache::remember('galleryImages', 10, function () {
            return PropertyImage::all()->take(4);
        });
        $institutes = Cache::remember('institutes', 10, function () {
            return Institute::all();
        });
        $allReviews = Cache::remember('allReviews', 10, function () {
            return Review::all();
        });

        $averageRatings = [
            'average_overall_rating' => round($allReviews->avg('overall_rating'), 2),
            'average_cleanliness_rating' => round($allReviews->avg('cleanliness_rating'), 2),
            'total_comments' => $allReviews->count(),
            'percentage_admin_response' => round($allReviews->where('admin_response', true)->count() / $allReviews->count() * 100, 2),
            'total_admin_response' => $allReviews->where('admin_response', true)->count(),
            'percentage_featured' => round($allReviews->where('is_featured', true)->count() / $allReviews->count() * 100, 2),
            'average_value_rating' => round($allReviews->avg('value_rating'), 2),
            'average_management_rating' => round($allReviews->avg('management_rating'), 2),
        ];

        return view('home', compact('properties', 'featuredRooms', 'roomPromo', 'galleryImages', 'averageRatings', 'institutes', 'allReviews'));
    }
}
