<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    |
    | This section contains all the contact information for the hostel.
    |
    */
    'contact' => [
        'phone' => [
            'primary' => env('HOSTEL_PHONE_PRIMARY', '+1 (329) 580-7077'),
            'secondary' => env('HOSTEL_PHONE_SECONDARY', '+1 (650) 382-5020'),
        ],
        'email' => [
            'primary' => env('HOSTEL_EMAIL_PRIMARY', 'contact@hosteller.com'),
            'secondary' => env('HOSTEL_EMAIL_SECONDARY', 'support@hosteller.com'),
        ],
        'address' => [
            'line1' => env('HOSTEL_ADDRESS_LINE1', '54826 Fadel Circles'),
            'line2' => env('HOSTEL_ADDRESS_LINE2', 'Darrylstad, AZ 90995'),
        ],
        'hours' => [
            'days' => env('HOSTEL_HOURS_DAYS', 'Everyday'),
            'time' => env('HOSTEL_HOURS_TIME', '10 am — 20 pm'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media Links
    |--------------------------------------------------------------------------
    |
    | This section contains all the social media links for the hostel.
    |
    */
    'social' => [
        'facebook' => env('HOSTEL_SOCIAL_FACEBOOK', '#'),
        'instagram' => env('HOSTEL_SOCIAL_INSTAGRAM', '#'),
        'twitter' => env('HOSTEL_SOCIAL_TWITTER', '#'),
        'whatsapp' => env('HOSTEL_SOCIAL_WHATSAPP', '#'),
        'description' => env('HOSTEL_SOCIAL_DESCRIPTION', 'Follow us on social media for updates and special offers'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Booking Settings
    |--------------------------------------------------------------------------
    |
    | This section contains booking-related settings.
    |
    */
    'booking' => [
        'check_in_time' => env('HOSTEL_CHECK_IN_TIME', '14:00'),
        'check_out_time' => env('HOSTEL_CHECK_OUT_TIME', '11:00'),
        'max_guests_per_room' => env('HOSTEL_MAX_GUESTS_PER_ROOM', 4),
        'cancellation_hours' => env('HOSTEL_CANCELLATION_HOURS', 24),
        'tax_rate' => env('HOSTEL_TAX_RATE', 0.08), // 8%
        'service_fee_rate' => env('HOSTEL_SERVICE_FEE_RATE', 0.05), // 5%
    ],

    /*
    |--------------------------------------------------------------------------
    | Room Settings
    |--------------------------------------------------------------------------
    |
    | This section contains room-related settings.
    |
    */
    'rooms' => [
        'featured_count' => env('HOSTEL_FEATURED_ROOMS_COUNT', 6),
        'per_page' => env('HOSTEL_ROOMS_PER_PAGE', 12),
        'related_count' => env('HOSTEL_RELATED_ROOMS_COUNT', 4),
    ],

    /*
    |--------------------------------------------------------------------------
    | Map Settings
    |--------------------------------------------------------------------------
    |
    | This section contains map-related settings.
    |
    */
    'map' => [
        'api_key' => env('GOOGLE_MAPS_API_KEY', ''),
        'latitude' => env('HOSTEL_MAP_LATITUDE', '37.7749'),
        'longitude' => env('HOSTEL_MAP_LONGITUDE', '-122.4194'),
        'zoom' => env('HOSTEL_MAP_ZOOM', 15),
    ],

    /*
    |--------------------------------------------------------------------------
    | Email Settings
    |--------------------------------------------------------------------------
    |
    | This section contains email-related settings.
    |
    */
    'email' => [
        'from_name' => env('HOSTEL_EMAIL_FROM_NAME', 'Hosteller'),
        'from_address' => env('HOSTEL_EMAIL_FROM_ADDRESS', 'noreply@hosteller.com'),
        'booking_confirmation_template' => env('HOSTEL_BOOKING_CONFIRMATION_TEMPLATE', 'emails.booking.confirmation'),
        'contact_form_template' => env('HOSTEL_CONTACT_FORM_TEMPLATE', 'emails.contact.form'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Settings
    |--------------------------------------------------------------------------
    |
    | This section contains payment-related settings.
    |
    */
    'payment' => [
        'currency' => env('HOSTEL_PAYMENT_CURRENCY', 'USD'),
        'currency_symbol' => env('HOSTEL_PAYMENT_CURRENCY_SYMBOL', '$'),
        'stripe_public_key' => env('STRIPE_PUBLIC_KEY', ''),
        'stripe_secret_key' => env('STRIPE_SECRET_KEY', ''),
        'paypal_client_id' => env('PAYPAL_CLIENT_ID', ''),
        'paypal_secret' => env('PAYPAL_SECRET', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO Settings
    |--------------------------------------------------------------------------
    |
    | This section contains SEO-related settings.
    |
    */
    'seo' => [
        'default_title' => env('HOSTEL_SEO_DEFAULT_TITLE', 'Hosteller - Student Accommodation Booking'),
        'default_description' => env('HOSTEL_SEO_DEFAULT_DESCRIPTION', 'Book affordable student accommodation with Hosteller. Comfortable rooms, great location, and excellent service.'),
        'default_keywords' => env('HOSTEL_SEO_DEFAULT_KEYWORDS', 'hostel, student accommodation, budget accommodation, travel, booking'),
    ],
]; 