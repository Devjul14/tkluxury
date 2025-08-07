@use('Illuminate\Support\Number');

@extends('layouts.app')

@section('title', 'Rooms')

@php
$page = 'rooms';
@endphp

@push('styles')
<!-- <style>
    .field:not(.field.booking_group-field) {
        border: none !important;
    }

    .rooms_main-filter {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        font-family: sans-serif;
    }

    .rooms_main-filter_form {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rooms_main-filter_form-wrapper {
        display: flex;
        justify-content: center;
        gap: .5rem;
    }

    .rooms_main-filter_form-group {
        display: flex;
        flex-direction: column;
        width: min(45%, 10rem);
    }

    /* Tablet: ≤1024px */
    @media (max-width: 1024px) {
        .rooms_main-filter_form-group {
            width: 10rem;
        }
    }

    /* Mobile: ≤768px */
    @media (max-width: 768px) {
        .rooms_main-filter_form-group {
            width: 100%;
        }
    }


    .rooms_main-filter_form-group_label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
        color: #333;
    }

    .rooms_main-filter_form-group_wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 0.1rem 0.3rem;
    }

    .rooms_main-filter_form-group_field {
        flex: 1;
        width: 40%;
        border: none;
        outline: none;
        background: transparent;
        font-size: 0.9rem;
        outline: none;
        appearance: none;
    }

    .rooms_main-filter_form-group_wrapper .icon {
        font-size: 1rem;
        color: #888;
        flex-shrink: 0;
    }

    /* Kalau mau chevron ke kanan selalu di ujung kanan */
    .rooms_main-filter_form-group_wrapper .icon:last-child {
        margin-left: auto;
    }

    .rooms_main-filter_form-submit {
        padding: 0.65rem 1.5rem;
        border: none;
        color: #fff;
        font-weight: 600;
        align-self: center;
        border-radius: 6px;
        cursor: pointer;
        gap: 0.5rem;
        transition: background-color 0.2s ease;
    }

    .rooms_main-filter_form-submit i {
        font-size: 1rem;
        color: #fff;
    }

    .rooms_main-filter_form-submit-text {
        font-size: 1rem;
    }

    /* Chrome, Safari, Edge (WebKit/Blink) */
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }

    /* Firefox */
    input[type="date"]::-moz-calendar-picker-indicator {
        display: none;
    }

    /* Remove default style on all */
    input[type="date"] {
        position: relative;
        z-index: 1;
        background: none;
    }
</style> -->

<style>
  .filter-container {
            background: white;
            border-radius: 20px;
            /* padding: 2rem; */
            /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); */
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .rooms_main-filter_form {
            width: 100%;
        }
        
        .rooms_main-filter_form-wrapper {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 0;
            align-items: end;
            flex-wrap: wrap;
        }
        
        .rooms_main-filter_form-group {
            flex: 1;
            min-width: 200px;
        }
        
        .rooms_main-filter_form-group_label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .rooms_main-filter_form-group_wrapper {
            position: relative;
            display: flex;
            align-items: center;
            /* background: #f8f9fa; */
            /* border: 2px solid #e9ecef; */
            /* border-radius: 12px; */
            /* padding: 0.75rem 1rem; */
            transition: all 0.3s ease;
        }
        
        .rooms_main-filter_form-group_wrapper:focus-within {
            /* border-color: #667eea; */
            /* box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25); */
            background: white;
        }
        
        .rooms_main-filter_form-group_wrapper .icon:first-child {
            color: #6c757d;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        
        .rooms_main-filter_form-group_field {
            flex: 1;
            border: none;
            background: transparent;
            color: #495057;
            font-size: 1rem;
            outline: none;
            cursor: pointer;
        }
        
        .rooms_main-filter_form-group_field input {
            width: 100%;
            border: none;
            background: transparent;
            outline: none;
            color: #495057;
            font-size: 1rem;
        }
        
        .rooms_main-filter_form-group_field option {
            padding: 0.5rem;
        }
        
        .rooms_main-filter_form-group_wrapper .icon:last-child {
            color: #6c757d;
            margin-left: 0.5rem;
            font-size: 0.8rem;
            transition: transform 0.2s ease;
        }
        
        .rooms_main-filter_form-group_wrapper:hover .icon:last-child {
            transform: translateY(2px);
        }
        
        .rooms_main-filter_form-submit {
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            height: 54px;
            white-space: nowrap;
            min-width: 120px;
        }
        
        .rooms_main-filter_form-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }
        
        .rooms_main-filter_form-submit:active {
            transform: translateY(0);
        }
        
        .rooms_main-filter_form-submit-text {
            font-weight: 600;
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #2c3e50;
            font-weight: 300;
        }
        
        .form-subtitle {
            text-align: center;
            margin-bottom: 2rem;
            color: #6c757d;
            font-size: 1.1rem;
        }
        
        @media (max-width: 768px) {
            .rooms_main-filter_form-wrapper {
                flex-direction: column;
                align-items: stretch;
            }
            
            .rooms_main-filter_form-group {
                width: 100%;
                min-width: unset;
            }
            
            .filter-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
        
        /* Loading animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        .loading .rooms_main-filter_form-submit {
            background: #6c757d;
        }
        
        .loading .rooms_main-filter_form-submit .icon {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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

<section class="rooms section">
    <div class="container">
        <div class="rooms_main">
            <div class="rooms_main-filter mb-4">
                <!-- <form id="filterForm" class="rooms_main-filter_form" action="{{ route('rooms.index') }}" method="GET">
                    <div class="rooms_main-filter_form-wrapper">
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="checkIn">Check-in</label>
                            <label class="rooms_main-filter_form-group_wrapper" for="checkIn">
                                <i class="icon-calendar icon"></i>
                                <input
                                    class="rooms_main-filter_form-group_field field flatpickr"
                                    type="date"
                                    id="checkIn"
                                    name="check_in"
                                    placeholder="Add date"
                                    value="{{ request('check_in', 'Add date') }}" />
                                <i class="icon-chevron_down icon"></i>
                            </label>
                        </div>
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="checkOut">Check-out</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="icon-calendar icon"></i>
                                <input
                                    class="rooms_main-filter_form-group_field field flatpickr"
                                    type="date"
                                    id="checkOut"
                                    placeholder="Add date"
                                    name="check_out"
                                    value="{{ request('check_out', 'Add date') }}" />
                                <i class="icon-chevron_down icon"></i>
                            </div>
                        </div>
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="guests">Guests</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="icon-user icon"></i>
                                <select class="rooms_main-filter_form-group_field field" id="guest" name="guests">
                                    <option value="">-- Guests --</option>
                                    @foreach ($roomGuests as $guest)
                                    <option value="{{ $guest }}" {{ request('guests') == $guest ? 'selected' : '' }}>{{ $guest }} Guests</option>
                                    @endforeach
                                </select>
                                <i class="icon-chevron_down icon"></i>
                            </div>
                        </div>
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="price">Price Range</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="icon-dollar icon"></i>
                                <select class="rooms_main-filter_form-group_field field" id="price" name="price_range">
                                    <option value="">All Prices</option>
                                    @foreach($roomPrices as $price)
                                    <option value="{{ $price }}" {{ request('price_range') == $price ? 'selected' : '' }}>{{ $price }}</option>
                                    @endforeach
                                </select>
                                <i class="icon-chevron_down icon"></i>
                            </div>
                        </div>
                        <div class="rooms_main-filter_form-group">
                            <label class="rooms_main-filter_form-group_label" for="type">Room Type</label>
                            <div class="rooms_main-filter_form-group_wrapper">
                                <i class="icon-room icon"></i>
                                <select class="rooms_main-filter_form-group_field field" id="type" name="room_type">
                                    <option value="">All Types</option>
                                    <option value="single" {{ request('room_type') == 'single' ? 'selected' : '' }}>Single Room</option>
                                    <option value="double" {{ request('room_type') == 'double' ? 'selected' : '' }}>Double Room</option>
                                    <option value="dormitory" {{ request('room_type') == 'dormitory' ? 'selected' : '' }}>Dormitory</option>
                                    <option value="private" {{ request('room_type') == 'private' ? 'selected' : '' }}>Private Room</option>
                                </select>
                                <i class="icon-chevron_down icon"></i>
                            </div>
                        </div>
                    </div>
                    <button id="filterSubmit" class="rooms_main-filter_form-submit theme-element theme-element--accent btn" type="submit">
                        <span class="rooms_main-filter_form-submit-text">Search</span>
                        <i class="icon-search icon"></i>
                    </button>
                </form> -->
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
</section>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d",
        });

        document.querySelector('#filterSubmit').addEventListener('click', function(e) {
            document.querySelector('#filterForm').submit();
        });
    });
</script>
<script src="{{ asset('asset/js/rooms.min.js') }}"></script>
@endpush