@extends('layouts.app')

@section('title', 'Home')

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
    .booking_group-field input,
    /* */
    .booking_group-field select {
        z-index: 999999999;
        position: relative;
        -webkit-appearance: none;
        /* Removes default dropdown arrow */
        -moz-appearance: none;
        appearance: none;
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

    .pagination-page_link:focus,
    .pagination-page_link:hover,
    .pagination-page_link[data-current=true] {
        font-weight: 600;
        color: #fff;
        background: #235784
    }

    @media screen and (min-width:991.98px) {
        .pagination {
            margin-top: 60px
        }
    }

    select.booking_group-field {
        background: transparent;
        outline: none;
        width: 100%;
        border: none;
    }
</style>
@endpush

@section('content')
<section class="hero section">
    <div class="container mb-8 container--hero d-lg-flex align-items-center justify-content-between">
        <div class="hero_main" style="width: 100% !important">
            <form class="booking" action="{{ route('properties.index') }}" method="get" autocomplete="off" data-type="booking" data-aos="fade-up" style="width: 100% !important">
                <div class="item-wrapper d-sm-flex flex-wrap flex-lg-nowrap align-items-lg-center" style="width: 100% !important">
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
                        <label class="booking_group-label h5" for="institute">Institute</label>
                        <div class="booking_group-wrapper">
                            <i class="icon-location icon"></i>
                            <select class="booking_group-field field" name="institute" id="institute">
                                <option value="" selected>All Institutes</option>
                                @foreach($institutes as $institute)
                                <option value="{{ $institute->id }}" {{ request('institute') == $institute->id ? 'selected' : '' }}>{{ $institute->name }}</option>
                                @endforeach
                            </select>
                            <i class="icon-chevron_down icon"></i>
                        </div>
                    </div>

                    <div class="booking_group d-flex flex-column">
                        <span class="booking_group-label h5">Student</span>
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
            @foreach($properties as $index => $property)
            <li class="rooms_list-item col-md-6 col-xl-4 mb-4"
                data-order="{{ $index + 1 }}"
                data-aos="fade-up"
                data-aos-delay="{{ $index * 50 }}">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ $property->getThumbnailAttribute() ? asset($property->getThumbnailAttribute()) : asset('img/property.jpg') }}" srcset="{{ $property->getThumbnailAttribute() ? asset($property->getThumbnailAttribute()) : asset('img/property.jpg') }}" />
                            <img class="lazy" data-src="{{ $property->getThumbnailAttribute() ? asset($property->getThumbnailAttribute()) : asset('img/property.jpg') }}" src="{{ $property->getThumbnailAttribute() ? asset($property->getThumbnailAttribute()) : asset('img/property.jpg') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--pricing">
                            <span class="price h4">${{ $property->price_per_month }}</span>
                            / month
                        </span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="{{ route('properties.show', $property->property_code) }}" data-shave="true">
                            {{ $property->title ?? 'Lorem ipsum' }}
                        </a>
                        <div class="main_amenities">
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <svg width="15" height="20" viewBox="0 0 42 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.8125 54.9062C19.7969 56.4375 22.0938 56.4375 23.0781 54.9062C39.0469 31.9375 42 29.5312 42 21C42 9.40625 32.5938 0 21 0C9.29688 0 0 9.40625 0 21C0 29.5312 2.84375 31.9375 18.8125 54.9062ZM21 29.75C16.0781 29.75 12.25 25.9219 12.25 21C12.25 16.1875 16.0781 12.25 21 12.25C25.8125 12.25 29.75 16.1875 29.75 21C29.75 25.9219 25.8125 29.75 21 29.75Z" fill="#235784" />
                                </svg>
                                &nbsp;Distance to Institute {{ $property->distance_to_institute }} km
                            </span>
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-user icon"></i>
                                Available room {{ $property->available_rooms }}
                            </span>
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-bunk_bed icon"></i>
                                Type {{ $property->property_type }}
                            </span>
                        </div>
                        <a class="link link--arrow d-inline-flex align-items-center" href="{{ route('properties.show', $property->property_code) }}">
                            See more
                            <i class="icon-arrow_right icon"></i>
                        </a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <x-pagination :paginator="$pagedProperties" />

    </div>
</section>
<section class="rooms section--blockbg section--nopb">
    <div class="block"></div>

</section>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/gallery.min.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fields = document.querySelectorAll('form input, form select');

        fields.forEach((field) => {
            field.addEventListener('change', function(e) {
                // Do not submit for student input, it requires dropdown interaction
                if (e.target.name !== 'student') {
                    e.target.closest('form').submit();
                }
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
@endpush