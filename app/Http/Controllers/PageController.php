<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function about()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        return view('about');
    }

    public function gallery()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $galleryImages = PropertyImage::all()->take(4);

        return view('gallery', compact('galleryImages'));
    }

    public function faq()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        return view('faq');
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
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        return view('policy.privacy');
    }

    public function refund_policy()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        return view('policy.refund');
    }

    public function term()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        return view('policy.term');
    }
}
