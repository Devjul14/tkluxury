<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyImage;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function gallery()
    {
        $galleryImages = PropertyImage::all()->take(4);

        return view('gallery', compact('galleryImages'));
    }

    public function faq()
    {
        // Sample FAQ data
        $faqs = [
            [
                'question' => 'What time is check-in and check-out?',
                'answer' => 'Check-in is from 2:00 PM to 10:00 PM, and check-out is at 11:00 AM. If you need to arrive earlier or later, please contact us in advance.',
                'category' => 'booking',
            ],
            [
                'question' => 'Do you provide towels and linens?',
                'answer' => 'Yes, we provide fresh towels and linens for all guests. Towels are changed daily, and linens are changed every 3 days for longer stays.',
                'category' => 'amenities',
            ],
            [
                'question' => 'Is breakfast included?',
                'answer' => 'We offer a complimentary continental breakfast from 7:00 AM to 10:00 AM daily. This includes coffee, tea, bread, jam, and seasonal fruits.',
                'category' => 'amenities',
            ],
            [
                'question' => 'Can I cancel my booking?',
                'answer' => 'Yes, you can cancel your booking up to 24 hours before check-in for a full refund. Cancellations within 24 hours may be subject to a cancellation fee.',
                'category' => 'booking',
            ],
            [
                'question' => 'Do you have parking available?',
                'answer' => 'We have limited parking spaces available on a first-come, first-served basis. There\'s also public parking nearby. Please contact us in advance if you need parking.',
                'category' => 'facilities',
            ],
            [
                'question' => 'Is the hostel safe?',
                'answer' => 'Yes, we have 24/7 security and secure lockers for your belongings. We also have CCTV cameras throughout the property for your safety.',
                'category' => 'safety',
            ],
        ];

        $faqs = collect($faqs)->map(function ($faq) {
            return (object) $faq;
        });

        return view('faq', compact('faqs'));
    }

    public function faq2()
    {
        // Alternative FAQ layout
        return $this->faq();
    }

    public function error()
    {
        return view('error');
    }

    public function notFound()
    {
        return view('404');
    }

    public function privacy_policy()
    {
        return view('policy.privacy');
    }

    public function refund_policy()
    {
        return view('policy.refund');
    }

    public function term()
    {
        return view('policy.term');
    }
}
