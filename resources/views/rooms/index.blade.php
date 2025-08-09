@use('Illuminate\Support\Number');

@extends('layouts.app')

@section('title', 'Rooms')

@php
$page = 'index';
@endphp

@push('styles')
<style>
    .container--hero {
        position: relative;
        z-index: 999999999;
        background-color: transparent;
    }
    .container--hero *,
    .booking_group-field,
    .booking_group-field input {
        z-index: 999999999;
        position: relative;
    }
    .hero_main:before {
        background-color: transparent !important;
        display: none;
    }

    .pickmeup.pmu-view-days {
        display: none;
    }

    .flatpickr-calendar {
        margin-top: 2rem;
    }


    .pagination {
        margin-top: 40px
    }

    .pagination-page {
        margin-right: 10px
    }

    .pagination-page:last-of-type {
        margin-right: 0
    }

    .pagination-page_link {
        width: 30px;
        height: 30px;
        border-radius: 4px
    }

    .pagination-page_link:focus,.pagination-page_link:hover,.pagination-page_link[data-current=true] {
        font-weight: 600;
        color: #fff;
        background: #235784
    }

    @media screen and (min-width:991.98px) {
        .pagination {
            margin-top: 60px
        }
    }

</style>
@endpush

@section('content')
<header class="page">
    <div class="container">
        <div class="page_header">
            <h1 class="page_header-title" data-aos="fade-up">Our Rooms</h1>
            <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                Egestas pretium aenean pharetra magna ac. Et tortor consequat id porta nibh venenatis cras sed
            </p>
        </div>
    </div>
</header>

<!-- <section class="rooms section">
    <div class="container">
        <div class="rooms_main">
            <div class="rooms_main-filter mb-4">
                <form id="filterForm" class="rooms_main-filter_form d-flex flex-column" action="/rooms" method="GET">
                    <div class="rooms_main-filter_form-wrapper">
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="checkIn">Check-in</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="fas fa-calendar icon"></i>
                                <input
                                    class="rooms_main-filter_form-group_field field"
                                    type="date"
                                    id="checkIn"
                                    name="check_in"
                                    value="{{ request('check_in', old('check_in')) }}"
                                    placeholder="Add date" />
                                <i class="fas fa-chevron-down icon"></i>
                            </div>
                        </div>
                        
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="checkOut">Check-out</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="fas fa-calendar icon"></i>
                                <input
                                    class="rooms_main-filter_form-group_field field"
                                    type="date"
                                    id="checkOut"
                                    value="{{ request('check_out', old('check_out')) }}"
                                    placeholder="Add date"
                                    name="check_out" />
                                <i class="fas fa-chevron-down icon"></i>
                            </div>
                        </div>
                        
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="guests">Guests</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="fas fa-user icon"></i>
                                <select class="rooms_main-filter_form-group_field field" id="guest" name="guests">
                                    <option value="">-- Guests --</option>
                                    @foreach ($roomGuests as $guest)
                                    <option value="{{ $guest }}" {{ request('guests') == $guest ? 'selected' : '' }}>{{ $guest }} Guests</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down icon"></i>
                            </div>
                        </div>
                        
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="price">Price Range</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="fas fa-dollar-sign icon"></i>
                                <select class="rooms_main-filter_form-group_field field" id="price" name="price_range">
                                    <option value="">All Prices</option>
                                    @foreach ($roomPrices as $price)
                                    <option value="{{ $price }}" {{ request('price_range') == $price ? 'selected' : '' }}>{{ $price }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down icon"></i>
                            </div>
                        </div>
                        
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="type">Room Type</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="fas fa-home icon"></i>
                                <select class="rooms_main-filter_form-group_field field" id="type" name="room_type">
                                    <option value="">All Types</option>
                                    @foreach ($roomTypes as $type)
                                    <option value="{{ $type }}" {{ request('room_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down icon"></i>
                            </div>
                        </div>
                        
                        <div class="rooms_main-filter_form-group">
                            <button id="filterSubmit" class="rooms_main-filter_form-submit theme-element theme-element--accent btn" type="submit">
                                <span class="rooms_main-filter_form-submit-text">Search</span>
                                <i class="fas fa-search icon"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="rooms_list">
                @forelse($rooms as $room)
                <div class="rooms_list-item" data-order="1" data-aos="fade-up">
                    <div class="item-wrapper d-md-flex">
                        <div class="media">
                            <picture>
                                <source data-srcset="{{ $room->image ? asset($room->image) : 'asset/img/hero.webp' }}" srcset="{{ $room->image ? asset($room->image) : 'asset/img/hero.webp' }}" />
                                <img class="lazy" data-src="{{ $room->image ? asset($room->image) : 'asset/img/hero.webp' }}" src="{{ $room->image ? asset($room->image) : 'asset/img/hero.webp' }}" alt="media" />
                            </picture>
                        </div>
                        <div class="main d-md-flex justify-content-between">
                            <div class="main_info d-md-flex flex-column justify-content-between">
                                <a class="main_title h4" href="room.html">{{ $room->name }}</a>
                                <p class="main_description">{{ Str::limit($room->description, 100) }}</p>
                                <div class="main_amenities">
                                    <span class="main_amenities-item d-inline-flex align-items-center">
                                        <i class="icon-user icon"></i>
                                        {{ $room->capacity }}
                                    </span>
                                    <span class="main_amenities-item d-inline-flex align-items-center">
                                        <i class="icon-bunk_bed icon"></i>
                                        {{ $room->room_type_label }}
                                    </span>
                                </div>
                            </div>
                            <div class="main_pricing d-flex flex-column align-items-md-end justify-content-md-between">
                                <div class="wrapper d-flex flex-column">
                                    <span class="main_pricing-item">
                                        <span class="h2">{{ Number::currency($room->price_per_month / 30, env('APP_DEFAULT_CURRENCY', 'USD')) }}</span>
                                        / 1 night
                                    </span>
                                    <span class="main_pricing-item">
                                        <span class="h4">{{ Number::currency($room->price_per_month / 30 * 7, env('APP_DEFAULT_CURRENCY', 'USD')) }}</span>
                                        / 7 nights
                                    </span>
                                </div>
                                <a class="theme-element theme-element--accent btn" href="{{ route('rooms.show', $room->id) }}">Book now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="rooms_main-empty text-center">
                    <h3>No rooms found</h3>
                    <p>Try adjusting your search criteria or check back later for new availability.</p>
                </div>
                @endforelse
            </div>
            <x-pagination :paginator="$pagedRooms" />
        </div>
</section> -->
<section class="hero section">
    <div class="container mb-8 container--hero d-lg-flex align-items-center justify-content-between">
        <div class="hero_main">
            <form class="booking" action="{{ route('rooms.index') }}" method="get" autocomplete="off" data-type="booking" data-aos="fade-up">
                <div class="item-wrapper d-sm-flex flex-wrap flex-lg-nowrap align-items-lg-center">
                    <div class="booking_group d-flex flex-column">
                        <label class="booking_group-label h5" for="checkIn">Check-in</label>
                        <div class="booking_group-wrapper">
                            <i class="icon-calendar icon"></i>
                            <input
                                class="booking_group-field field required flatpickr"
                                data-type="date"
                                data-start="true"
                                type="text"
                                id="checkIn"
                                placeholder="Add date"
                                name="check_in"
                                value="{{ request('check_in', old('check_in')) }}"
                                readonly />
                            <i class="icon-chevron_down icon"></i>
                        </div>
                    </div>
                    <div class="booking_group d-flex flex-column">
                        <label class="booking_group-label h5" for="checkOut">Check-out</label>
                        <div class="booking_group-wrapper">
                            <i class="icon-calendar icon"></i>
                            <input
                                class="booking_group-field field required flatpickr"
                                data-type="date"
                                data-end="true"
                                type="text"
                                id="checkOut"
                                name="check_out"
                                placeholder="Add date"
                                value="{{ request('check_out', old('check_out')) }}"
                                readonly />
                            <i class="icon-chevron_down icon"></i>
                        </div>
                    </div>
                    <div class="booking_group d-flex flex-column">
                        <span class="booking_group-label h5">Capacity</span>
                        <div class="booking_group-wrapper booking_group-wrapper--guests">
                            <i class="icon-user icon"></i>
                            <div
                                class="booking_group-field dropdown-toggle"
                                role="presentation"
                                id="guests"
                                data-bs-toggle="collapse"
                                data-bs-target="#bookingDropdown"></div>
                            <div class="booking_group-dropdown collapse" id="bookingDropdown">
                                <div class="content">
                                    <div class="booking_group-dropdown_wrapper d-flex align-items-center justify-content-between">
                                        <label class="label h5" for="student">Student</label>
                                        <div class="main d-flex align-items-center justify-content-between">
                                            <a class="qty_minus qty-changer d-flex align-items-center justify-content-center" href="#" data-disabled="true"></a>
                                            <input class="field required" id="adults" name="student" type="text" value="{{ old('student', request('student') ?? 1) }}" />
                                            <a class="qty_plus qty-changer d-flex align-items-center justify-content-center" href="#" data-disabled="">+</a>
                                        </div>
                                    </div>
                                    <div class="booking_group-dropdown_wrapper d-flex align-items-center justify-content-between" style="display: none !important;">
                                        <label class="label h5" for="children">Children</label>
                                        <div class="main d-flex align-items-center justify-content-between">
                                            <a class="qty_minus qty-changer d-flex align-items-center justify-content-center" href="#" data-disabled=""></a>
                                            <input class="field required" id="children" name="children" type="text" value="{{ old('children', request('children') ?? 0) }}" />
                                            <a class="qty_plus qty-changer d-flex align-items-center justify-content-center" href="#" data-disabled="">+</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="filterSubmit" class="booking_btn btn theme-element theme-element--accent" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container mt-4">
        <ul class="rooms_list d-md-flex flex-wrap">
            @foreach($rooms as $index => $room)
            <li class="rooms_list-item col-md-6 col-xl-4 mb-4"
                data-order="{{ $index + 1 }}"
                data-aos="fade-up"
                data-aos-delay="{{ $index * 50 }}">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ $room->getThumbnailAttribute() ? asset($room->getThumbnailAttribute()) : asset('img/property.jpg') }}" srcset="{{ $room->getThumbnailAttribute() ? asset($room->getThumbnailAttribute()) : asset('img/property.jpg') }}" />
                            <img class="lazy" data-src="{{ $room->getThumbnailAttribute() ? asset($room->getThumbnailAttribute()) : asset('img/property.jpg') }}" src="{{ $room->getThumbnailAttribute() ? asset($room->getThumbnailAttribute()) : asset('img/property.jpg') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--pricing">
                            <span class="price h4">${{ $room->price_per_month }}</span>
                            / month
                        </span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="{{ route('rooms.show', $room->id) }}" data-shave="true">
                            {{ $room->title ?? 'Lorem ipsum' }}
                        </a>
                        <div class="main_amenities">
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-bunk_bed icon"></i>
                                Type {{ $room->room_type }}
                            </span>
                        </div>
                        <a class="link link--arrow d-inline-flex align-items-center" href="{{ route('rooms.show', $room->id) }}">
                            See more
                            <i class="icon-arrow_right icon"></i>
                        </a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <x-pagination :paginator="$pagedRooms" />

    </div>
</section>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fields = document.querySelectorAll('form input, form select');
        
        fields.forEach((field) => {
            field.addEventListener('change', function(e) {
                e.target.closest('form').submit();
            });
        });

        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d",
        });

        document.querySelector('#filterSubmit').addEventListener('click', function(e) {
            e.target.closest('form').submit();
        });
    });
</script>
<script src="{{ asset('asset/js/rooms.min.js') }}"></script>
@endpush