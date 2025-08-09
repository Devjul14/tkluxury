@use('Illuminate\Support\Number')

@extends('layouts.app')

@section('title', $property->name)

@php
$page = 'room';
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('asset/css/room.min.css') }}">
<style>
    .review {
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .review_header {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 0.5rem;
    }

    .review_form {
        gap: 1rem;
    }

    .review_rating {
        width: 100%;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .review_rating-block {
        flex: 1 1 45%;
        background: #f9f9f9;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .review_rating-block label {
        flex: 1;
        margin-right: 1rem;
        font-weight: 500;
    }

    .star-rating {
        flex: 1;
        padding: 0.4rem 0.6rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        background: #fff;
        font-size: 0.9rem;
        appearance: none;
    }

    .field-wrapper {
        position: relative;
        width: 48%;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        border-radius: 4px;
        border: 1px solid #ccc;
        padding: 0 0.75rem;
    }

    .field-wrapper .label {
        color: #999;
        font-size: 1rem;
    }

    .field-wrapper .icon {
        margin-right: 0.5rem;
    }

    .field {
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        border: none !important;
        outline: none !important;
        background-color: transparent;
    }

    .textarea {
        width: 100%;
        height: 12rem !important;
        resize: vertical;
        padding: 0.75rem !important;
        margin-bottom: 1rem;
        border: 1px solid #ccc !important;
        border-radius: 4px !important;
    }

    .btn.theme-element {
        padding: 0.75rem 1.5rem;
        background-color: #007bff;
        color: white;
        border: none;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn.theme-element:hover {
        background-color: #0056b3;
    }
</style>
@endpush

@section('content')

<header class="page">
    <div class="container">
        <ul class="breadcrumbs d-flex flex-wrap align-content-center">
            <li class="list-item">
                <a class="link" href="index.html">Home</a>
            </li>

            <li class="list-item">
                <a class="link" href="{{ route('properties.index') }}">Properties</a>
            </li>
            <li class="list-item">
                <a class="link" href="#">{{ $property->title }}</a>
            </li>
        </ul>
        <h1 class="page_title">{{ $property->title }}</h1>
    </div>
</header>
<!-- single room content start -->
<main>
    <!-- room section start -->
    <form class="room section" action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="room_main d-lg-flex flex-wrap align-items-start">
                <div class="room_main-slider col-12 d-lg-flex">
                    <div class="room_main-slider_view col-lg-8">
                        <div class="swiper-wrapper">
                            @forelse ($property->images->where('is_primary', true) as $image)
                            <div class="swiper-slide">
                                <picture>
                                    <source data-srcset="{{ $image->image_path ? asset('storage/' . $image->image_path) : url('asset/img/hero.webp') }}" srcset="{{ $image->image_path ? asset('storage/' . $image->image_path) : url('asset/img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ $image->image_path ? asset('storage/' . $image->image_path) : url('asset/img/hero.webp') }}" src="{{ $image->image_path ? asset('storage/' . $image->image_path) : url('asset/img/hero.webp') }}" alt="media" />
                                </picture>
                            </div>
                            @empty
                            <div class="swiper-slide">
                                <picture>
                                    <source data-srcset="{{ url('asset/img/hero.webp') }}" srcset="{{ url('asset/img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ url('asset/img/hero.webp') }}" src="{{ url('asset/img/hero.webp') }}" alt="media" />
                                </picture>
                            </div>
                            @endforelse
                        </div>
                        <div class="swiper-controls d-flex align-items-center justify-content-between">
                            <a class="swiper-button-prev d-inline-flex align-items-center justify-content-center" href="#">
                                <i class="icon-arrow_left icon"></i>
                            </a>
                            <a class="swiper-button-next d-inline-flex align-items-center justify-content-center" href="#">
                                <i class="icon-arrow_right icon"></i>
                            </a>
                        </div>
                    </div>
                    <div class="room_main-slider_thumbs">
                        <div class="swiper-wrapper">
                            @forelse ($property->images->where('is_primary', false) as $image)
                            <div class="swiper-slide">
                                <picture>
                                    <source data-srcset="{{ $image ? asset('storage/' . $image->image_path) : url('asset/img/hero.webp') }}" srcset="{{ $image ? asset('storage/' . $image->image_path) : url('asset/img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ $image ? asset('storage/' . $image->image_path) : url('asset/img/hero.webp') }}" src="{{ $image ? asset('storage/' . $image->image_path) : url('asset/img/hero.webp') }}" alt="media" />
                                </picture>
                            </div>
                            @empty
                            <div class="swiper-slide">
                                <picture>
                                    <source data-srcset="{{ url('asset/img/hero.webp') }}" srcset="{{ url('asset/img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ url('asset/img/hero.webp') }}" src="{{ url('asset/img/hero.webp') }}" alt="media" />
                                </picture>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="room_main-info col-lg-8">
                    <div class="amenities d-flex flex-wrap align-items-center">
                        <span class="amenities_item d-inline-flex align-items-center">
                            <i class="icon-location icon"></i>
                            {{ $property->address }}
                        </span>
                        <span class="amenities_item d-inline-flex align-items-center">
                            <i class="icon-bunk_bed icon"></i>
                            {{ $property->rooms->count() }}
                        </span>
                    </div>
                    <div class="description">
                        <p class="description_text">
                            {{ $property->description }}
                        </p>
                    </div>
                    <section class="facilities">
                        <h4 class="facilities_header">Property facilities</h4>
                        <div class="facilities_list d-sm-flex flex-wrap">
                            @foreach($property->features->chunk(3) as $chunk)
                            @foreach($chunk as $feature)
                            <div class="facilities_list-block">
                                <span class="facilities_list-block_item d-flex align-items-center">
                                    <span class="icon-{{ $feature->icon }} icon"></span>
                                    {{ $feature->name }}
                                </span>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                    </section>

                    <div class="rating">
                        <span class="rating_summary">
                            <span class="h2">4.25</span>
                            <sup class="h4">/5</sup>
                        </span>
                        <div class="rating_list d-flex flex-wrap">
                            <div class="rating_list-item d-sm-flex align-items-center justify-content-between" data-order="1">
                                <span class="label">Location</span>
                                <span class="progressLine" id="location" data-value="4.7" data-fill="#0DA574"></span>
                            </div>
                            <div class="rating_list-item d-sm-flex align-items-center justify-content-between" data-order="2">
                                <span class="label">Comfort</span>
                                <span class="progressLine" id="comfort" data-value="4.5" data-fill="#0DA574"></span>
                            </div>
                            <div class="rating_list-item d-sm-flex align-items-center justify-content-between" data-order="3">
                                <span class="label">Pricing</span>
                                <span class="progressLine" id="pricing" data-value="4.9" data-fill="#0DA574"></span>
                            </div>
                            <div class="rating_list-item d-sm-flex align-items-center justify-content-between" data-order="4">
                                <span class="label">Service</span>
                                <span class="progressLine" id="service" data-value="4.8" data-fill="#0DA574"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="room_main-cards col-lg-4">
                    <div class="room_main-cards_card" style="padding: 0; height: 18rem;">
                        <iframe
                            width="100%"
                            height="100%"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAFmDPs9yBFzKNC6o0ozgOP5c_Rmrz7F1k&q={{ $property->latitude && $property->longitude ? $property->latitude . ',' . $property->longitude : setting('map', '3.139003,101.686855') }}&zoom=8&maptype=roadmap">
                        </iframe>
                    </div>


                </div>
            </div>

            <div class="row">
                <!-- rooms section start -->
                <section class="rooms section--blockbg section">
                    <div class="block"></div>
                    <div class="container">
                        <div class="rooms_header d-sm-flex justify-content-between align-items-center">
                            <h2 class="rooms_header-title" data-aos="fade-right">Property rooms</h2>
                            <div class="wrapper" data-aos="fade-left">
                                <a class="btn theme-element theme-element--light" href="rooms.html">View all rooms</a>
                            </div>
                        </div>
                        <ul class="rooms_list d-md-flex flex-wrap">
                            @foreach ($relatedRooms as $room)
                            <li class="rooms_list-item col-md-6 mb-4 col-xl-4" data-order="1" data-aos="fade-up">
                                <div class="item-wrapper d-md-flex flex-column">
                                    <div class="media">
                                        <picture>
                                            <source data-srcset="{{ $room->getThumbnailAttribute() ? asset($room->getThumbnailAttribute()) : url('asset/img/hero.webp') }}" srcset="{{ $room->getThumbnailAttribute() ? asset($room->getThumbnailAttribute()) : url('asset/img/hero.webp') }}" />
                                            <img class="lazy" data-src="{{ $room->getThumbnailAttribute() ? asset($room->getThumbnailAttribute()) : url('asset/img/hero.webp') }}" src="{{ $room->getThumbnailAttribute() ? asset($room->getThumbnailAttribute()) : url('asset/img/hero.webp') }}" alt="media" />
                                        </picture>
                                        <span class="media_label media_label--pricing">
                                            <span class="price h4">{{ Number::currency($room->price_per_month / 30, env('APP_DEFAULT_CURRENCY', 'IDR')) }}</span>
                                            / 1 night
                                        </span>
                                    </div>
                                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                                        <a class="main_title h4" href="{{ route('rooms.show', $room->id) }}" data-shave="true">#{{ $room->room_number }}</a>
                                        <div class="main_amenities">
                                            <span class="main_amenities-item d-inline-flex align-items-center">
                                                <i class="icon-user icon"></i>
                                                {{ $room->capacity }} Sleeps
                                            </span>
                                            <span class="main_amenities-item d-inline-flex align-items-center">
                                                <i class="icon-bunk_bed icon"></i>
                                                {{ $room->room_type_label }}
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
                    </div>
                </section>
                <!-- rooms section end -->
                <!-- <section class="room_comments col-md-6">
                    <h3 class="room_comments-header">Post comments</h3>
                    <ul class="room_comments-list">
                        <li class="list-item d-flex flex-column flex-sm-row align-items-start">
                            <div class="media">
                                <picture>
                                    <source data-srcset="img/hero.webp" srcset="img/hero.webp" />
                                    <img class="lazy" data-src="img/hero.webp" src="img/hero.webp" alt="media" />
                                </picture>
                            </div>
                            <div class="main">
                                <div class="main_info d-flex flex-column">
                                    <span class="name h4">Gloria Ellis</span>
                                    <span class="date">June 16, 2021</span>
                                </div>
                                <p class="text">
                                    Ac placerat vestibulum lectus mauris ultrices. Velit scelerisque in dictum non consectetur a. Eget
                                    nunc lobortis mattis aliquam faucibus purus in. Ultricies leo integer malesuada nunc.
                                </p>
                            </div>
                            <a class="replyTrigger" href="#">
                                <span class="icon-reply"></span>
                            </a>
                        </li>
                    </ul>

                </section>
                <div class="col-md-6">
                    <div class="room_main-cards_card  accent">
                        <h3 class="title">Stay Longer, Save More</h3>
                        <p class="text">It's simple: the longer you stay, the more you save!</p>
                        <div class="content">
                            <p class="text">Save up to <b>20%</b> off the nightly rate on stays between 7-14 nights</p>
                            <p class="text">Save up to <b>30%</b> off the nightly rate on stays between 14-29 nights</p>
                        </div>
                    </div>
                </div> -->

            </div>

            <!-- <section class="review col-lg-8">
                <h3 class="review_header">Leave comment</h3>
                <form
                    class="review_form contacts_form form d-sm-flex flex-wrap justify-content-between"
                    action="#"
                    method="post"
                    data-type="reviewRoom">
                    <div class="review_rating d-flex flex-wrap">
                        <div class="review_rating-block d-sm-flex align-items-center justify-content-between" data-order="1">
                            <label class="label h6" for="locationStars">Location</label>
                            <select class="star-rating" id="locationStars">
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Average</option>
                                <option value="2">Poor</option>
                                <option value="1">Terrible</option>
                            </select>
                        </div>
                        <div class="review_rating-block d-sm-flex align-items-center justify-content-between" data-order="2">
                            <label class="label h6" for="pricingStars">Pricing</label>
                            <select class="star-rating" id="pricingStars">
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Average</option>
                                <option value="2">Poor</option>
                                <option value="1">Terrible</option>
                            </select>
                        </div>
                        <div class="review_rating-block d-sm-flex align-items-center justify-content-between" data-order="3">
                            <label class="label h6" for="comfortStars">Comfort</label>
                            <select class="star-rating" id="comfortStars">
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Average</option>
                                <option value="2">Poor</option>
                                <option value="1">Terrible</option>
                            </select>
                        </div>
                        <div class="review_rating-block d-sm-flex align-items-center justify-content-between" data-order="4">
                            <label class="label h6" for="serviceStars">Service</label>
                            <select class="star-rating" id="serviceStars">
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Average</option>
                                <option value="2">Poor</option>
                                <option value="1">Terrible</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-wrapper">
                        <label class="label" for="reviewRoomName">
                            <i class="icon-user icon"></i>
                        </label>
                        <input class="field required" id="reviewRoomName" type="text" placeholder="Name" />
                    </div>
                    <div class="field-wrapper">
                        <label class="label" for="reviewRoomEmail">
                            <i class="icon-email icon"></i>
                        </label>
                        <input class="field required" id="reviewRoomEmail" type="text" data-type="email" placeholder="Email" />
                    </div>
                    <textarea class="field textarea required" id="reviewRoomMessage" placeholder="Message"></textarea>
                    <button class="btn theme-element theme-element--accent" type="submit">Submit</button>
                </form>
            </section> -->
        </div>
    </form>
    <!-- room section start -->
    <!-- recommendation section start -->
    <!-- <section class="recommendation section">
        <div class="container d-xl-flex">
            <div class="main">
                <h4 class="main_subtitle">Recommendation for you</h4>
                <h2 class="main_title" data-aos="fade-up">Standard Twin Room Private Shared Bathroom</h2>
                <div class="main_amenities d-flex flex-wrap align-items-center">
                    <span class="main_amenities-item d-inline-flex align-items-center" data-aos="fade-up">
                        <i class="icon-twin_bed icon"></i>
                        1 full bed
                    </span>
                    <span class="main_amenities-item d-inline-flex align-items-center" data-aos="fade-up">
                        <i class="icon-bunk_bed icon"></i>
                        2 twin bed
                    </span>
                </div>
                <p class="main_text" data-aos="fade-up" data-aos-delay="50">
                    Condimentum id venenatis a condimentum vitae sapien pellentesque habitant. At augue eget arcu dictum varius duis
                    at consectetur
                </p>
                <ul class="main_list">
                    <li class="main_list-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="50">
                        <span class="icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M27.9997 14.7341V7.33329C27.9997 7.15648 27.9294 6.98691 27.8044 6.86189C27.6794 6.73686 27.5098 6.66663 27.333 6.66663H4.66634C4.48953 6.66663 4.31996 6.73686 4.19494 6.86189C4.06991 6.98691 3.99967 7.15648 3.99967 7.33329V14.7341C3.24737 14.8887 2.57136 15.2979 2.0856 15.8928C1.59985 16.4877 1.33405 17.2319 1.33301 18V26C1.33301 26.1768 1.40325 26.3463 1.52827 26.4714C1.65329 26.5964 1.82286 26.6666 1.99967 26.6666H4.66634C4.84315 26.6666 5.01272 26.5964 5.13775 26.4714C5.26277 26.3463 5.33301 26.1768 5.33301 26V22.6666H26.6663V26C26.6663 26.1768 26.7366 26.3463 26.8616 26.4714C26.9866 26.5964 27.1562 26.6666 27.333 26.6666H29.9997C30.1765 26.6666 30.3461 26.5964 30.4711 26.4714C30.5961 26.3463 30.6663 26.1768 30.6663 26V18C30.6654 17.2319 30.3996 16.4877 29.9138 15.8928C29.4281 15.2979 28.752 14.8886 27.9997 14.7341ZM5.33301 7.99996H26.6663V14.6666H23.9997V11.3333C23.9997 11.1565 23.9294 10.9869 23.8044 10.8619C23.6794 10.7369 23.5098 10.6666 23.333 10.6666H17.9997C17.8229 10.6666 17.6533 10.7369 17.5283 10.8619C17.4032 10.9869 17.333 11.1565 17.333 11.3333V14.6666H14.6663V11.3333C14.6663 11.1565 14.5961 10.9869 14.4711 10.8619C14.3461 10.7369 14.1765 10.6666 13.9997 10.6666H8.66634C8.48953 10.6666 8.31996 10.7369 8.19494 10.8619C8.06991 10.9869 7.99967 11.1565 7.99967 11.3333V14.6666H5.33301V7.99996ZM22.6663 14.6666H18.6663V12H22.6663V14.6666ZM13.333 14.6666H9.33301V12H13.333V14.6666ZM29.333 25.3333H27.9997V22C27.9997 21.8231 27.9294 21.6536 27.8044 21.5286C27.6794 21.4035 27.5098 21.3333 27.333 21.3333H4.66634C4.48953 21.3333 4.31996 21.4035 4.19494 21.5286C4.06991 21.6536 3.99967 21.8231 3.99967 22V25.3333H2.66634V18C2.66692 17.4697 2.87782 16.9613 3.25277 16.5864C3.62772 16.2114 4.13609 16.0005 4.66634 16H27.333C27.8633 16.0005 28.3716 16.2114 28.7466 16.5864C29.1215 16.9613 29.3324 17.4697 29.333 18V25.3333Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        Large bed
                    </li>
                    <li class="main_list-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
                        <span class="icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M26.2786 7.84667C26.3436 7.78509 26.3956 7.71106 26.4314 7.62899C26.4671 7.54691 26.4861 7.45848 26.487 7.36895C26.4879 7.27942 26.4708 7.19062 26.4367 7.10783C26.4026 7.02505 26.3522 6.94997 26.2884 6.88707C23.5465 4.18306 19.8503 2.66711 15.9994 2.66711C12.1484 2.66711 8.45223 4.18306 5.7103 6.88707C5.64658 6.94997 5.59616 7.02505 5.56205 7.10783C5.52795 7.19062 5.51084 7.27942 5.51175 7.36895C5.51267 7.45848 5.53158 7.54691 5.56738 7.62899C5.60317 7.71106 5.65511 7.78509 5.7201 7.84667L8.6289 10.6032L15.541 17.1514C15.6649 17.2685 15.8289 17.3337 15.9994 17.3337C16.1698 17.3337 16.3338 17.2685 16.4577 17.1514L26.2786 7.84667ZM10.0723 10.1333C11.7398 8.75474 13.8358 8.00054 15.9994 8.00054C18.163 8.00054 20.2589 8.75474 21.9264 10.1333L19.9357 12.0195C18.7895 11.1932 17.4123 10.7485 15.9994 10.7485C14.5864 10.7485 13.2092 11.1932 12.063 12.0195L10.0723 10.1333ZM15.9994 4.00001C19.2628 3.99296 22.414 5.19111 24.8483 7.36461L22.8923 9.21794C20.973 7.57171 18.5279 6.66674 15.9994 6.66674C13.4708 6.66674 11.0257 7.57171 9.10643 9.21794L7.15043 7.36461C9.58478 5.19111 12.7359 3.99296 15.9994 4.00001ZM13.0255 12.931C13.9048 12.3403 14.9401 12.0248 15.9994 12.0248C17.0587 12.0248 18.094 12.3403 18.9732 12.931L15.9994 15.7487L13.0255 12.931Z"
                                    fill="currentColor" />
                                <path
                                    d="M8.66634 22.6667C8.84315 22.6667 9.01272 22.5965 9.13774 22.4714C9.26277 22.3464 9.33301 22.1769 9.33301 22C9.33301 21.8232 9.26277 21.6537 9.13774 21.5286C9.01272 21.4036 8.84315 21.3334 8.66634 21.3334H5.99967C5.82286 21.3334 5.65329 21.4036 5.52827 21.5286C5.40325 21.6537 5.33301 21.8232 5.33301 22V27.3334C5.33301 27.5102 5.40325 27.6798 5.52827 27.8048C5.65329 27.9298 5.82286 28 5.99967 28C6.17649 28 6.34605 27.9298 6.47108 27.8048C6.5961 27.6798 6.66634 27.5102 6.66634 27.3334V25.3334H8.66634C8.84315 25.3334 9.01272 25.2631 9.13774 25.1381C9.26277 25.0131 9.33301 24.8435 9.33301 24.6667C9.33301 24.4899 9.26277 24.3203 9.13774 24.1953C9.01272 24.0703 8.84315 24 8.66634 24H6.66634V22.6667H8.66634Z"
                                    fill="currentColor" />
                                <path
                                    d="M15.9993 23.3334C15.9988 22.8031 15.7879 22.2947 15.4129 21.9198C15.038 21.5449 14.5296 21.334 13.9993 21.3334H11.3327C11.1559 21.3334 10.9863 21.4036 10.8613 21.5286C10.7363 21.6537 10.666 21.8232 10.666 22V27.3334C10.666 27.5102 10.7363 27.6798 10.8613 27.8048C10.9863 27.9298 11.1559 28 11.3327 28C11.5095 28 11.6791 27.9298 11.8041 27.8048C11.9291 27.6798 11.9993 27.5102 11.9993 27.3334V25.3334H12.9993L14.7993 27.7334C14.8519 27.8034 14.9177 27.8624 14.993 27.907C15.0684 27.9516 15.1517 27.981 15.2384 27.9933C15.3251 28.0057 15.4133 28.0009 15.4981 27.9792C15.5829 27.9575 15.6626 27.9192 15.7327 27.8667C15.8027 27.8142 15.8617 27.7484 15.9063 27.673C15.9509 27.5977 15.9803 27.5143 15.9926 27.4277C16.005 27.341 16.0002 27.2527 15.9785 27.1679C15.9568 27.0831 15.9185 27.0034 15.866 26.9334L14.5912 25.2334C14.9978 25.1081 15.3537 24.8562 15.607 24.5144C15.8603 24.1726 15.9978 23.7588 15.9993 23.3334ZM13.9993 24H11.9993V22.6667H13.9993C14.1762 22.6667 14.3457 22.7369 14.4708 22.862C14.5958 22.987 14.666 23.1566 14.666 23.3334C14.666 23.5102 14.5958 23.6798 14.4708 23.8048C14.3457 23.9298 14.1762 24 13.9993 24Z"
                                    fill="currentColor" />
                                <path
                                    d="M20.6663 22.6667C20.8432 22.6667 21.0127 22.5965 21.1377 22.4714C21.2628 22.3464 21.333 22.1769 21.333 22C21.333 21.8232 21.2628 21.6537 21.1377 21.5286C21.0127 21.4036 20.8432 21.3334 20.6663 21.3334H17.9997C17.8229 21.3334 17.6533 21.4036 17.5283 21.5286C17.4032 21.6537 17.333 21.8232 17.333 22V27.3334C17.333 27.5102 17.4032 27.6798 17.5283 27.8048C17.6533 27.9298 17.8229 28 17.9997 28H20.6663C20.8432 28 21.0127 27.9298 21.1377 27.8048C21.2628 27.6798 21.333 27.5102 21.333 27.3334C21.333 27.1566 21.2628 26.987 21.1377 26.862C21.0127 26.7369 20.8432 26.6667 20.6663 26.6667H18.6663V25.3334H20.6663C20.8432 25.3334 21.0127 25.2631 21.1377 25.1381C21.2628 25.0131 21.333 24.8435 21.333 24.6667C21.333 24.4899 21.2628 24.3203 21.1377 24.1953C21.0127 24.0703 20.8432 24 20.6663 24H18.6663V22.6667H20.6663Z"
                                    fill="currentColor" />
                                <path
                                    d="M25.9993 25.3334C26.1762 25.3334 26.3457 25.2631 26.4708 25.1381C26.5958 25.0131 26.666 24.8435 26.666 24.6667C26.666 24.4899 26.5958 24.3203 26.4708 24.1953C26.3457 24.0703 26.1762 24 25.9993 24H23.9993V22.6667H25.9993C26.1762 22.6667 26.3457 22.5965 26.4708 22.4714C26.5958 22.3464 26.666 22.1769 26.666 22C26.666 21.8232 26.5958 21.6537 26.4708 21.5286C26.3457 21.4036 26.1762 21.3334 25.9993 21.3334H23.3327C23.1559 21.3334 22.9863 21.4036 22.8613 21.5286C22.7363 21.6537 22.666 21.8232 22.666 22V27.3334C22.666 27.5102 22.7363 27.6798 22.8613 27.8048C22.9863 27.9298 23.1559 28 23.3327 28H25.9993C26.1762 28 26.3457 27.9298 26.4708 27.8048C26.5958 27.6798 26.666 27.5102 26.666 27.3334C26.666 27.1566 26.5958 26.987 26.4708 26.862C26.3457 26.7369 26.1762 26.6667 25.9993 26.6667H23.9993V25.3334H25.9993Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        High speed WiFi
                    </li>
                    <li class="main_list-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="150">
                        <span class="icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M27.3333 5.33337H4.66667C4.48986 5.33337 4.32029 5.40361 4.19526 5.52864C4.07024 5.65366 4 5.82323 4 6.00004V16.6667C4 16.8435 4.07024 17.0131 4.19526 17.1381C4.32029 17.2631 4.48986 17.3334 4.66667 17.3334H27.3333C27.5101 17.3334 27.6797 17.2631 27.8047 17.1381C27.9298 17.0131 28 16.8435 28 16.6667V6.00004C28 5.82323 27.9298 5.65366 27.8047 5.52864C27.6797 5.40361 27.5101 5.33337 27.3333 5.33337ZM26.6667 6.66671V8.00004H5.33333V6.66671H26.6667ZM5.33333 16V9.33337H26.6667V16H5.33333Z"
                                    fill="currentColor" />
                                <path
                                    d="M8.66667 20C8.48986 20 8.32029 20.0702 8.19526 20.1953C8.07024 20.3203 8 20.4899 8 20.6667C8 23.0133 5.54947 25.3333 4.66667 25.3333C4.48986 25.3333 4.32029 25.4036 4.19526 25.5286C4.07024 25.6536 4 25.8232 4 26C4 26.1768 4.07024 26.3464 4.19526 26.4714C4.32029 26.5964 4.48986 26.6667 4.66667 26.6667C6.38 26.6667 9.33333 23.7018 9.33333 20.6667C9.33333 20.4899 9.26309 20.3203 9.13807 20.1953C9.01305 20.0702 8.84348 20 8.66667 20Z"
                                    fill="currentColor" />
                                <path
                                    d="M27.3337 25.3333C26.4509 25.3333 24.0003 23.0133 24.0003 20.6667C24.0003 20.4899 23.9301 20.3203 23.8051 20.1953C23.68 20.0702 23.5105 20 23.3337 20C23.1568 20 22.9873 20.0702 22.8623 20.1953C22.7372 20.3203 22.667 20.4899 22.667 20.6667C22.667 23.7018 25.6203 26.6667 27.3337 26.6667C27.5105 26.6667 27.68 26.5964 27.8051 26.4714C27.9301 26.3464 28.0003 26.1768 28.0003 26C28.0003 25.8232 27.9301 25.6536 27.8051 25.5286C27.68 25.4036 27.5105 25.3333 27.3337 25.3333Z"
                                    fill="currentColor" />
                                <path
                                    d="M14.0003 20C13.8235 20 13.6539 20.0702 13.5289 20.1953C13.4039 20.3203 13.3337 20.4899 13.3337 20.6667C13.3337 23.1523 12.0876 25.3333 11.3337 25.3333C11.1568 25.3333 10.9873 25.4036 10.8623 25.5286C10.7372 25.6536 10.667 25.8232 10.667 26C10.667 26.1768 10.7372 26.3464 10.8623 26.4714C10.9873 26.5964 11.1568 26.6667 11.3337 26.6667C13.2412 26.6667 14.667 23.4987 14.667 20.6667C14.667 20.4899 14.5968 20.3203 14.4717 20.1953C14.3467 20.0702 14.1771 20 14.0003 20Z"
                                    fill="currentColor" />
                                <path
                                    d="M20.6663 25.3333C19.9124 25.3333 18.6663 23.1523 18.6663 20.6667C18.6663 20.4899 18.5961 20.3203 18.4711 20.1953C18.3461 20.0702 18.1765 20 17.9997 20C17.8229 20 17.6533 20.0702 17.5283 20.1953C17.4032 20.3203 17.333 20.4899 17.333 20.6667C17.333 23.4987 18.7588 26.6667 20.6663 26.6667C20.8432 26.6667 21.0127 26.5964 21.1377 26.4714C21.2628 26.3464 21.333 26.1768 21.333 26C21.333 25.8232 21.2628 25.6536 21.1377 25.5286C21.0127 25.4036 20.8432 25.3333 20.6663 25.3333Z"
                                    fill="currentColor" />
                                <path
                                    d="M24.667 13.3334H23.3337C23.1568 13.3334 22.9873 13.4036 22.8623 13.5286C22.7372 13.6537 22.667 13.8232 22.667 14C22.667 14.1769 22.7372 14.3464 22.8623 14.4714C22.9873 14.5965 23.1568 14.6667 23.3337 14.6667H24.667C24.8438 14.6667 25.0134 14.5965 25.1384 14.4714C25.2634 14.3464 25.3337 14.1769 25.3337 14C25.3337 13.8232 25.2634 13.6537 25.1384 13.5286C25.0134 13.4036 24.8438 13.3334 24.667 13.3334Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        Air conditioning
                    </li>
                </ul>
                <div class="wrapper" data-aos="fade-up">
                    <a class="btn theme-element theme-element--accent" href="#">Learn more</a>
                </div>
            </div>
            <div class="media" data-aos="fade-up">
                <picture>
                    <source data-srcset="img/hero.webp" srcset="img/hero.webp" />
                    <img class="lazy" data-src="img/hero.webp" src="img/hero.webp" alt="media" />
                </picture>
                <div class="media_review media_review--top" data-aos="fade-left">
                    <h4 class="media_review-text">This is the perfect hostel for a weekend getaway!</h4>
                    <div class="media_review-footer d-flex align-items-center">
                        <span class="avatar">
                            <picture>
                                <source data-srcset="img/hero.webp" srcset="img/hero.webp" />
                                <img
                                    class="lazy"
                                    data-src="img/hero.webp"
                                    src="img/hero.webp"
                                    alt="media" />
                            </picture>
                        </span>
                        <div class="wrapper d-flex flex-column">
                            <div class="stars d-flex align-items-center">
                                <i class="icon-star icon"></i>
                                <i class="icon-star icon"></i>
                                <i class="icon-star icon"></i>
                                <i class="icon-star icon"></i>
                                <i class="icon-star icon"></i>
                            </div>
                            <span class="name h6">Esmond Ward</span>
                        </div>
                    </div>
                </div>
                <div class="media_review media_review--bottom" data-aos="fade-right">
                    <h4 class="media_review-text">The room was wonderful and clean!</h4>
                    <div class="media_review-footer d-flex align-items-center">
                        <span class="avatar">
                            <picture>
                                <source data-srcset="img/hero.webp" srcset="img/hero.webp" />
                                <img
                                    class="lazy"
                                    data-src="img/hero.webp"
                                    src="img/hero.webp"
                                    alt="media" />
                            </picture>
                        </span>
                        <div class="wrapper d-flex flex-column">
                            <div class="stars d-flex align-items-center">
                                <i class="icon-star icon"></i>
                                <i class="icon-star icon"></i>
                                <i class="icon-star icon"></i>
                                <i class="icon-star icon"></i>
                                <i class="icon-star icon"></i>
                            </div>
                            <span class="name h6">Ella Sanchez</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- recommendation section end -->

    <!-- single room content start -->
</main>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/room.min.js') }}"></script>

<script>
    const bookings = document.querySelectorAll('button[type="submit"]');

    bookings.forEach((booking) => {
        booking.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            form.submit();
        });
    });
</script>
@endpush