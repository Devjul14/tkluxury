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

        $properties = Cache::remember('properties', 60, function () use ($request) {
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

            return $properties->get();
        });

        $featuredRooms = Cache::remember('featuredRooms', 60, function () use ($request) {
            $featuredRooms = Room::where('is_available', true);

            if ($request->filled('check_in') && $request->filled('check_out')) {
                $checkInCarbon = Carbon::createFromFormat('m.d.Y', $request->check_in);
                $checkOutCarbon = Carbon::createFromFormat('m.d.Y', $request->check_out);

                $featuredRooms->whereHas('bookings', function ($query) use ($checkInCarbon, $checkOutCarbon) {
                    $query
                        ->whereNot('check_in_date', '>=', $checkInCarbon)
                        ->whereNot('check_out_date', '<=', $checkOutCarbon);
                });
            }

            if ($request->filled('adults')) {
                $guests = $request->adults;
                $featuredRooms->where('capacity', '>=', $guests);
            }

            if ($request->filled('institute')) {
                $featuredRooms->whereHas('property', function ($query) use ($request) {
                    $query->where('institute_id', $request->institute);
                });
            }

            return $featuredRooms->get();
        });

        $roomPromo = $featuredRooms->count() > 0 ? $featuredRooms->random() : null;
        $galleryImages = Cache::remember('galleryImages', 60, function () {
            return PropertyImage::all()->take(4);
        });
        $institutes = Cache::remember('institutes', 60, function () {
            return Institute::all();
        });
        $allReviews = Cache::remember('allReviews', 60, function () {
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
