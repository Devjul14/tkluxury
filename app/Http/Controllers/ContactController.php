<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class ContactController extends Controller
{
    public function index()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        return view('contacts');
    }

    public function store(Request $request)
    {
        // Validate contact form
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'privacy' => 'required|accepted',
        ]);

        // Process contact form submission
        // Here you would typically:
        // 1. Save to database
        // 2. Send email notification
        // 3. Send auto-reply to user

        // For demo purposes, we'll just redirect with success message
        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function v2()
    {
        // Alternative contact page layout
        return view('contacts.v2');
    }
}
