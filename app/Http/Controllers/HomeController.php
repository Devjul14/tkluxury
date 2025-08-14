<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Review;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Sample featured rooms data
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $properties = Property::all();
        $featuredRooms = Room::where('is_available', true);

        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkInCarbon = Carbon::createFromFormat('m.d.Y', $request->check_in);
            $checkOutCarbon = Carbon::createFromFormat('m.d.Y', $request->check_out);

            $featuredRooms = $featuredRooms->whereHas('bookings', function ($query) use ($checkInCarbon, $checkOutCarbon) {
                $query
                    ->whereNot('check_in_date', '>=', $checkInCarbon)
                    ->whereNot('check_out_date', '<=', $checkOutCarbon);
            });
        }

        if ($request->filled('adults')) {
            $guests = $request->adults;
            $featuredRooms = $featuredRooms->where('capacity', '>=', $guests);
        }

        $featuredRooms = $featuredRooms->get();
        $roomPromo = $featuredRooms->count() > 0 ? $featuredRooms->random() : null;
        $galleryImages = PropertyImage::all()->take(4);
        // dd($galleryImages);
        $allReviews = Review::all();

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
        // dd($properties);

        return view('home', compact('properties', 'featuredRooms', 'roomPromo', 'galleryImages', 'averageRatings'));
    }
}
