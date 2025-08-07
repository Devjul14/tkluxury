@use('Illuminate\Support\Number');

@extends('layouts.app')

@section('title', 'Properties')

@php
$page = 'properties';
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('asset/css/rooms.min.css') }}">
<style>
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
        flex-direction: row;
    }

    .rooms_main-filter_form-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
    }

    .rooms_main-filter_form-group {
        display: flex;
        flex-direction: column;
        width: min(45%, 12rem);
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
        /* background-color: #f9f9f9; */
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 0.1rem 0.3rem;
    }

    .rooms_main-filter_form-group_field {
        flex: 1;
        width: 80%;
        border: none;
        outline: none;
        background: transparent;
        font-size: 0.8rem;
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
</style>
@endpush

@section('content')
<header class="page">
    <div class="container">
        <ul class="breadcrumbs d-flex flex-wrap align-content-center">
            <li class="list-item">
                <a class="link" href="{{ route('home') }}">Home</a>
            </li>

            <li class="list-item">
                <a class="link" href="{{ route('properties.index') }}">Properties</a>
            </li>
        </ul>
        <h1 class="page_title">Our Properties</h1>
    </div>
</header>

<main>
    <section class="rooms section">
        <div class="container">
            <div class="rooms_main">
                <div class="rooms_main-filter">
                    <form id="filterForm" class="rooms_main-filter_form" action="{{ route('properties.index') }}" method="GET">
                        <div class="rooms_main-filter_form-wrapper d-flex flex-wrap align-items-center">
                            <div class="rooms_main-filter_form-group">
                                <label class="rooms_main-filter_form-group_label" for="guests">Total Rooms</label>
                                <div class="rooms_main-filter_form-group_wrapper">
                                    <i class="icon-bunk_bed icon"></i>
                                    <select class="rooms_main-filter_form-group_field field" id="guest" name="room_count">
                                        <option value="">Select Total Rooms</option>
                                        @foreach ($propertyRoomCounts as $roomCount)
                                        <option value="{{ $roomCount }}" {{ request('room_count') == $roomCount ? 'selected' : '' }}>{{ $roomCount }} Rooms</option>
                                        @endforeach
                                    </select>
                                    <i class="icon-chevron_down icon"></i>
                                </div>
                            </div>
    
                            <div class="rooms_main-filter_form-group">
                                <label class="rooms_main-filter_form-group_label" for="institute">Institute</label>
                                <div class="rooms_main-filter_form-group_wrapper">
                                    <i class="icon-location icon"></i>
                                    <select class="rooms_main-filter_form-group_field field" id="institute" name="institute">
                                        <option value="">Select Institute</option>
                                        @foreach ($institutes as $institute)
                                        <option value="{{ $institute->id }}" {{ request('institute') == $institute->id ? 'selected' : '' }}>{{ $institute->name }}</option>
                                        @endforeach
                                    </select>
                                    <i class="icon-chevron_down icon"></i>
                                </div>
                            </div>
                        </div>
                    
                        <button id="filterSubmit" class="rooms_main-filter_form-submit theme-element theme-element--accent" type="submit">
                            <span class="rooms_main-filter_form-submit-text">Search</span>
                            <i class="icon-search icon"></i>
                        </button>
                    </form>
                </div>
                <div class="rooms_list">
                    @forelse($properties as $property)
                    <div class="rooms_list-item" data-order="1" data-aos="fade-up">
                        <div class="item-wrapper d-md-flex">
                            <div class="media">
                                <picture>
                                    <source data-srcset="{{ $property->images->count() > 0 ? asset($property->images->random()->image_path) : 'asset/img/hero.webp' }}" srcset="{{ $property->images->count() > 0 ? asset($property->images->random()->image_path) : 'asset/img/hero.webp' }}" />
                                    <img class="lazy" data-src="{{ $property->images->count() > 0 ? asset($property->images->random()->image_path) : 'asset/img/hero.webp' }}" src="{{ $property->images->count() > 0 ? asset($property->images->random()->image_path) : 'asset/img/hero.webp' }}" alt="media" />
                                </picture>
                            </div>
                            <div class="main d-md-flex justify-content-between">
                                <div class="main_info d-md-flex flex-column justify-content-between">
                                    <a class="main_title h4" href="room.html">{{ $property->name }}</a>
                                    <p class="main_description">{{ Str::limit($property->description, 100) }}</p>
                                    <div class="main_amenities">
                                        <span class="main_amenities-item d-inline-flex align-items-center">
                                            <i class="icon-location icon"></i>
                                            {{ $property->address }}
                                        </span>
                                        <span class="main_amenities-item d-inline-flex align-items-center">
                                            <i class="icon-bunk_bed icon"></i>
                                            {{ $property->rooms->count() }} Rooms
                                        </span>
                                    </div>
                                </div>
                                <div class="main_pricing d-flex flex-column align-items-md-end justify-content-md-between">
                                    <a class="theme-element theme-element--accent btn" href="{{ route('properties.show', $property->property_code) }}">View Detail Property</a>
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
                <x-pagination :paginator="$pagedProperties" />
            </div>
    </section>
</main>
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