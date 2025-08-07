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
                            @foreach ($property->images as $image)
                            <div class="swiper-slide">
                                <picture>
                                    <source data-srcset="{{ $image->image_path ? asset($image->image_path) : url('asset/img/hero.webp') }}" srcset="{{ $image->image_path ? asset($image->image_path) : url('asset/img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ $image->image_path ? asset($image->image_path) : url('asset/img/hero.webp') }}" src="{{ $image->image_path ? asset($image->image_path) : url('asset/img/hero.webp') }}" alt="media" />
                                </picture>
                            </div>
                            @endforeach
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
                            @foreach ($property->images as $image)
                            <div class="swiper-slide">
                                <picture>
                                    <source data-srcset="{{ $image->image_path ? asset($image->image_path) : url('asset/img/hero.webp') }}" srcset="{{ $image->image_path ? asset($image->image_path) : url('asset/img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ $image->image_path ? asset($image->image_path) : url('asset/img/hero.webp') }}" src="{{ $image->image_path ? asset($image->image_path) : url('asset/img/hero.webp') }}" alt="media" />
                                </picture>
                            </div>
                            @endforeach
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
                <section class="room_comments col-md-6">
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
                </div>

            </div>

            <section class="review col-lg-8">
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
            </section>
        </div>
    </form>
    <!-- room section start -->
    <!-- recommendation section start -->
    <section class="recommendation section">
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
    </section>
    <!-- recommendation section end -->
    <!-- stages section start -->
    <section class="about_stages section">
        <div class="container d-xl-flex align-items-center">
            <div class="about_stages-main col-xl-6">
                <h2 class="about_stages-main_header" data-aos="fade-right">Stages of booking a room</h2>
                <ul class="about_stages-main_list">
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up">
                        <div class="media">
                            <span class="theme-element">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M36.6667 5.33333H36V2C36 0.897333 35.1027 0 34 0H32.6667C31.564 0 30.6667 0.897333 30.6667 2V5.33333H9.33333V2C9.33333 0.897333 8.436 0 7.33333 0H6C4.89733 0 4 0.897333 4 2V5.33333H3.33333C1.49533 5.33333 0 6.82867 0 8.66667V36.6667C0 38.5047 1.49533 40 3.33333 40H36.6667C38.5047 40 40 38.5047 40 36.6667V8.66667C40 6.82867 38.5047 5.33333 36.6667 5.33333ZM32 6V2C32 1.632 32.2987 1.33333 32.6667 1.33333H34C34.368 1.33333 34.6667 1.632 34.6667 2V6V8.66667C34.6667 9.03467 34.368 9.33333 34 9.33333H32.6667C32.2987 9.33333 32 9.03467 32 8.66667V6ZM5.33333 2V6V8.66667C5.33333 9.03467 5.632 9.33333 6 9.33333H7.33333C7.70133 9.33333 8 9.03467 8 8.66667V6V2C8 1.632 7.70133 1.33333 7.33333 1.33333H6C5.632 1.33333 5.33333 1.632 5.33333 2ZM38.6667 36.6667C38.6667 37.7693 37.7693 38.6667 36.6667 38.6667H3.33333C2.23067 38.6667 1.33333 37.7693 1.33333 36.6667V17.3333H38.6667V36.6667ZM1.33333 16H38.6667V8.66667C38.6667 7.564 37.7693 6.66667 36.6667 6.66667H36V8.66667C36 9.76933 35.1027 10.6667 34 10.6667H32.6667C31.564 10.6667 30.6667 9.76933 30.6667 8.66667V6.66667H9.33333V8.66667C9.33333 9.76933 8.436 10.6667 7.33333 10.6667H6C4.89733 10.6667 4 9.76933 4 8.66667V6.66667H3.33333C2.23067 6.66667 1.33333 7.564 1.33333 8.66667V16Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M13.238 8H27.9046C28.2733 8 28.5713 8.31929 28.5713 8.71429V13C28.5713 13.395 28.2733 13.7143 27.9046 13.7143H13.238C12.8693 13.7143 12.5713 13.395 12.5713 13V8.71429C12.5713 8.31929 12.8693 8 13.238 8ZM13.9046 12.2857H27.238V9.42857H13.9046V12.2857Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M4.143 19.4285H8.42871C8.82371 19.4285 9.143 19.7204 9.143 20.0815V23.3468C9.143 23.708 8.82371 23.9999 8.42871 23.9999H4.143C3.748 23.9999 3.42871 23.708 3.42871 23.3468V20.0815C3.42871 19.7204 3.748 19.4285 4.143 19.4285ZM4.85728 22.6938H7.71443V20.7346H4.85728V22.6938Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M13.2856 19.4285H17.5713C17.9663 19.4285 18.2856 19.7204 18.2856 20.0815V23.3468C18.2856 23.708 17.9663 23.9999 17.5713 23.9999H13.2856C12.8906 23.9999 12.5713 23.708 12.5713 23.3468V20.0815C12.5713 19.7204 12.8906 19.4285 13.2856 19.4285ZM13.9999 22.6938H16.857V20.7346H13.9999V22.6938Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M22.4282 19.4285H26.7139C27.1089 19.4285 27.4282 19.7204 27.4282 20.0815V23.3468C27.4282 23.708 27.1089 23.9999 26.7139 23.9999H22.4282C22.0332 23.9999 21.7139 23.708 21.7139 23.3468V20.0815C21.7139 19.7204 22.0332 19.4285 22.4282 19.4285ZM23.1424 22.6938H25.9996V20.7346H23.1424V22.6938Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M31.5717 19.4285H35.8574C36.2524 19.4285 36.5717 19.7204 36.5717 20.0815V23.3468C36.5717 23.708 36.2524 23.9999 35.8574 23.9999H31.5717C31.1767 23.9999 30.8574 23.708 30.8574 23.3468V20.0815C30.8574 19.7204 31.1767 19.4285 31.5717 19.4285ZM32.286 22.6938H35.1431V20.7346H32.286V22.6938Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M4.143 26.2856H8.42871C8.82371 26.2856 9.143 26.5776 9.143 26.9387V30.204C9.143 30.5652 8.82371 30.8571 8.42871 30.8571H4.143C3.748 30.8571 3.42871 30.5652 3.42871 30.204V26.9387C3.42871 26.5776 3.748 26.2856 4.143 26.2856ZM4.85728 29.551H7.71443V27.5918H4.85728V29.551Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M13.2856 26.2856H17.5713C17.9663 26.2856 18.2856 26.5776 18.2856 26.9387V30.204C18.2856 30.5652 17.9663 30.8571 17.5713 30.8571H13.2856C12.8906 30.8571 12.5713 30.5652 12.5713 30.204V26.9387C12.5713 26.5776 12.8906 26.2856 13.2856 26.2856ZM13.9999 29.551H16.857V27.5918H13.9999V29.551Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M22.4282 26.2856H26.7139C27.1089 26.2856 27.4282 26.5776 27.4282 26.9387V30.204C27.4282 30.5652 27.1089 30.8571 26.7139 30.8571H22.4282C22.0332 30.8571 21.7139 30.5652 21.7139 30.204V26.9387C21.7139 26.5776 22.0332 26.2856 22.4282 26.2856ZM23.1424 29.551H25.9996V27.5918H23.1424V29.551Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M31.5717 26.2856H35.8574C36.2524 26.2856 36.5717 26.5776 36.5717 26.9387V30.204C36.5717 30.5652 36.2524 30.8571 35.8574 30.8571H31.5717C31.1767 30.8571 30.8574 30.5652 30.8574 30.204V26.9387C30.8574 26.5776 31.1767 26.2856 31.5717 26.2856ZM32.286 29.551H35.1431V27.5918H32.286V29.551Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M4.143 33.1428H8.42871C8.82371 33.1428 9.143 33.4347 9.143 33.7959V37.0612C9.143 37.4223 8.82371 37.7143 8.42871 37.7143H4.143C3.748 37.7143 3.42871 37.4223 3.42871 37.0612V33.7959C3.42871 33.4347 3.748 33.1428 4.143 33.1428ZM4.85728 36.4081H7.71443V34.4489H4.85728V36.4081Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M13.2856 33.1428H17.5713C17.9663 33.1428 18.2856 33.4347 18.2856 33.7959V37.0612C18.2856 37.4223 17.9663 37.7143 17.5713 37.7143H13.2856C12.8906 37.7143 12.5713 37.4223 12.5713 37.0612V33.7959C12.5713 33.4347 12.8906 33.1428 13.2856 33.1428ZM13.9999 36.4081H16.857V34.4489H13.9999V36.4081Z"
                                        fill="currentColor" />
                                    <path
                                        d="M27.4588 32L24.3479 35.0869L22.7371 33.755L21.7139 34.601L23.8848 36.3961C24.0201 36.5092 24.2046 36.5714 24.3964 36.5714C24.4072 36.5714 24.4181 36.5714 24.4289 36.5708C24.6323 36.5631 24.8219 36.4853 24.9528 36.3566L28.571 32.7665L27.4588 32Z"
                                        fill="currentColor" />
                                    <path
                                        d="M35.4588 32L32.3479 35.0869L30.7371 33.755L29.7139 34.601L31.8848 36.3961C32.0201 36.5092 32.2046 36.5714 32.3964 36.5714C32.4072 36.5714 32.4181 36.5714 32.4289 36.5708C32.6323 36.5631 32.8219 36.4853 32.9528 36.3566L36.571 32.7665L35.4588 32Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Room reservation</h4>
                            <p class="main_text">Integer eget aliquet nibh praesent tristique magna sit amet purus</p>
                        </div>
                    </li>
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="50">
                        <div class="media">
                            <span class="theme-element">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M39.3333 23.4906C39.702 23.4906 40 23.1947 40 22.8302V14.9057C40 14.5411 39.702 14.2453 39.3333 14.2453H29.0353C28.6387 13.3577 27.8647 12.6716 26.9153 12.4022L26.4793 12.2787C27.0153 11.5265 27.3333 10.6112 27.3333 9.62264C27.3333 7.07359 25.2393 5 22.6667 5C20.094 5 18 7.07359 18 9.62264C18 10.6997 18.3767 11.6896 19.0027 12.4768L18.2607 12.7707C17.838 12.9377 17.462 13.1841 17.1413 13.5017L15.0573 15.566H10.3333C9.04667 15.566 8 16.6028 8 17.8774C8 18.2333 8.08867 18.5668 8.234 18.8679H2C1.63133 18.8679 1.33333 19.1638 1.33333 19.5283V24.8113H0.666667C0.298 24.8113 0 25.1072 0 25.4717V28.1132C0 28.3338 0.111333 28.5398 0.296667 28.6626L2.29667 29.9834C2.406 30.0554 2.53533 30.0943 2.66667 30.0943H3.33333V39.3396C3.33333 39.7042 3.63133 40 4 40H36C36.3687 40 36.6667 39.7042 36.6667 39.3396V30.0943H37.3333C37.4647 30.0943 37.594 30.0554 37.7033 29.9834L39.7033 28.6626C39.8887 28.5398 40 28.3338 40 28.1132V25.4717C40 25.1072 39.702 24.8113 39.3333 24.8113H34.6667V23.4906H39.3333ZM22.6667 6.32075C24.5047 6.32075 26 7.80198 26 9.62264C26 10.6858 25.4813 11.6236 24.6907 12.2278C24.602 12.2952 24.5133 12.3619 24.4193 12.4193C24.382 12.4424 24.3432 12.4623 24.3043 12.4823C24.2842 12.4926 24.264 12.503 24.244 12.5138C23.4507 12.9278 22.5047 13.0124 21.6527 12.7522C21.6457 12.7499 21.6387 12.7478 21.6316 12.7458L21.6191 12.7421L21.619 12.7421L21.619 12.7421L21.619 12.7421C21.6034 12.7376 21.5878 12.7331 21.5727 12.7277C21.4387 12.6835 21.3093 12.6254 21.182 12.564C21.1087 12.5276 21.0367 12.4893 20.9667 12.4477C20.8747 12.3942 20.7847 12.3361 20.698 12.2734C19.8747 11.6705 19.3333 10.7109 19.3333 9.62264C19.3333 7.80198 20.8287 6.32075 22.6667 6.32075ZM15.3333 16.8868H10.3333C9.782 16.8868 9.33333 17.3312 9.33333 17.8774C9.33333 18.4235 9.782 18.8679 10.3333 18.8679H11.3333H16.4447L18.9333 17.0189C19.1353 16.869 19.406 16.8445 19.6313 16.9561C19.8573 17.0684 20 17.2969 20 17.5472V24.8113H28V23.4906H26.6667C26.298 23.4906 26 23.1947 26 22.8302V14.9057C26 14.5411 26.298 14.2453 26.6667 14.2453H27.472C27.2267 13.9752 26.908 13.7738 26.5487 13.6721L25.4187 13.3525C25.4127 13.3567 25.4063 13.3602 25.4 13.3637L25.4 13.3637C25.3937 13.3671 25.3873 13.3706 25.3813 13.3749C24.6153 13.9204 23.6793 14.2453 22.6667 14.2453C21.9713 14.2453 21.314 14.0894 20.7207 13.818C20.7119 13.8141 20.7033 13.8099 20.6949 13.8057L20.678 13.7975C20.4787 13.7038 20.2847 13.5994 20.102 13.4799C20.0992 13.4781 20.0962 13.4766 20.0934 13.4752C20.0901 13.4737 20.0868 13.4721 20.084 13.47L18.756 13.9963C18.5027 14.0974 18.2767 14.2446 18.0853 14.4348L15.8047 16.6933C15.68 16.8175 15.5107 16.8868 15.3333 16.8868ZM18.6667 18.8679V24.8113H12V20.1887H16.6667C16.8113 20.1887 16.9513 20.1425 17.0667 20.0566L18.6667 18.8679ZM10.3333 20.1887H2.66667V24.8113H10.6667V20.1887H10.3333ZM38.6667 26.1321V27.7599L37.1313 28.7736H36C35.6313 28.7736 35.3333 29.0694 35.3333 29.434V38.6792H4.66667V29.434C4.66667 29.0694 4.36867 28.7736 4 28.7736H2.86867L1.33333 27.7599V26.1321H2H11.3333H19.3333H28.6667H31.3333H34H38.6667ZM29.3333 23.4906V24.8113H30.6667V23.4906H29.3333ZM32 24.8113V23.4906H33.3333V24.8113H32ZM31.3333 22.1698H34H38.6667V15.566H28.57H27.3333V22.1698H28.6667H31.3333Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M0 6C0 2.692 2.69133 0 6 0C9.30867 0 12 2.692 12 6C12 9.308 9.30867 12 6 12C2.69133 12 0 9.308 0 6ZM6.66667 9.33333V10.6133C8.706 10.3193 10.3193 8.706 10.6133 6.66667H9.33333V5.33333H10.6133C10.3193 3.294 8.706 1.68067 6.66667 1.38667V2.66667H5.33333V1.38667C3.294 1.68067 1.68067 3.294 1.38667 5.33333H2.66667V6.66667H1.38667C1.68067 8.706 3.294 10.3193 5.33333 10.6133V9.33333H6.66667Z"
                                        fill="currentColor" />
                                    <path
                                        d="M7.01644 3L5.59705 5.19896L4.86922 4.35167L4 5.36185L5.22945 6.79068C5.34501 6.9257 5.50115 7 5.66405 7C5.67819 7 5.69295 6.99929 5.7077 6.99857C5.88535 6.98357 6.04887 6.87998 6.15583 6.71495L8 3.8573L7.01644 3Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Filling in documents and payment</h4>
                            <p class="main_text">Leo duis ut diam quam. Sed velit dignissim sodales ut eu</p>
                        </div>
                    </li>
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="media">
                            <span class="theme-element">
                                <svg width="40" height="38" viewBox="0 0 40 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M10 20H36.6667C38.5047 20 40 18.5047 40 16.6667V3.33333C40 1.49533 38.5047 0 36.6667 0H10C8.162 0 6.66667 1.49533 6.66667 3.33333V10.226C2.75067 11.912 0 15.8067 0 20.3333C0 24.8647 2.75533 28.7627 6.678 30.446C6.67691 30.4763 6.67481 30.5063 6.67272 30.5362L6.67271 30.5362C6.66969 30.5794 6.66667 30.6226 6.66667 30.6667C6.66667 34.71 9.95667 38 14 38C16.7653 38 19.2827 36.444 20.53 34H36.6667C36.8693 34 37.0607 33.908 37.1873 33.75L39.854 30.4167C39.9667 30.2753 40.0173 30.0953 39.9947 29.916C39.972 29.7367 39.8773 29.5747 39.7333 29.4667L37.0667 27.4667C36.9513 27.38 36.8113 27.3333 36.6667 27.3333H35.3333C35.1107 27.3333 34.9027 27.4447 34.7787 27.63L33.8967 28.9533L32.4713 27.528C32.3467 27.4033 32.1773 27.3333 32 27.3333H30.6667C30.298 27.3333 30 27.6313 30 28V29.3333H28.4807L27.966 27.7893C27.8747 27.5167 27.6207 27.3333 27.3333 27.3333H24.6667C24.444 27.3333 24.236 27.4447 24.112 27.63L23.3333 28.798L22.5547 27.63C22.4307 27.4447 22.2227 27.3333 22 27.3333H20.53C19.2827 24.8893 16.766 23.3333 14 23.3333C10.512 23.3333 7.59 25.7833 6.852 29.0513C3.59467 27.4947 1.33333 24.1773 1.33333 20.3333C1.33333 16.562 3.50933 13.2973 6.66667 11.7047V16.6667C6.66667 18.5047 8.162 20 10 20ZM8 11.1493C8.674 10.9287 9.37933 10.7793 10.1087 10.712C10.422 11.8353 11.444 12.6667 12.6667 12.6667C14.1373 12.6667 15.3333 11.4707 15.3333 10C15.3333 8.52933 14.1373 7.33333 12.6667 7.33333C11.4107 7.33333 10.3613 8.20867 10.08 9.38C9.36467 9.43933 8.67 9.56933 8 9.76V3.33333C8 2.23067 8.89733 1.33333 10 1.33333H36.6667C37.7693 1.33333 38.6667 2.23067 38.6667 3.33333V16.6667C38.6667 17.7693 37.7693 18.6667 36.6667 18.6667H10C8.89733 18.6667 8 17.7693 8 16.6667V11.1493ZM12.6667 8.66667C12.1753 8.66667 11.75 8.93667 11.5187 9.33333H12.6667V10.6667H11.5187C11.75 11.0633 12.1753 11.3333 12.6667 11.3333C13.402 11.3333 14 10.7353 14 10C14 9.26467 13.402 8.66667 12.6667 8.66667ZM11 30C10.9744 30 10.9494 29.9982 10.9243 29.9963C10.9017 29.9946 10.8791 29.993 10.856 29.9927C11.0887 29.6 11.512 29.3333 12 29.3333C12.7353 29.3333 13.3333 29.9313 13.3333 30.6667C13.3333 31.402 12.7353 32 12 32C11.506 32 11.078 31.7267 10.848 31.3253C10.8709 31.3259 10.8933 31.3276 10.9158 31.3292L10.9158 31.3292L10.9159 31.3292C10.9437 31.3313 10.9716 31.3333 11 31.3333H12V30H11ZM14.6667 30.6667C14.6667 32.1373 13.4707 33.3333 12 33.3333C10.7127 33.3333 9.63533 32.4167 9.38733 31.2013C8.91867 31.132 8.45933 31.0367 8.012 30.91C8.14133 34.1053 10.7733 36.6667 14 36.6667C16.3833 36.6667 18.5413 35.2533 19.4973 33.0667C19.6033 32.8233 19.8433 32.6667 20.108 32.6667H36.3467L38.3827 30.1207L36.4447 28.6667H35.69L34.5547 30.37C34.444 30.536 34.2647 30.644 34.066 30.6633C33.8647 30.682 33.67 30.6127 33.5287 30.4713L31.724 28.6667H31.3333V30C31.3333 30.3687 31.0353 30.6667 30.6667 30.6667H28C27.7127 30.6667 27.4587 30.4833 27.3673 30.2107L26.8527 28.6667H25.0233L23.888 30.37C23.6407 30.7413 23.026 30.7413 22.7787 30.37L21.6433 28.6667H20.108C19.8433 28.6667 19.6033 28.5093 19.4973 28.2667C18.5413 26.08 16.3833 24.6667 14 24.6667C11.0713 24.6667 8.62933 26.7773 8.10733 29.5567C8.54733 29.6953 9.00467 29.792 9.46933 29.8667C9.81133 28.7887 10.81 28 12 28C13.4707 28 14.6667 29.196 14.6667 30.6667Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M10 20H36.6667C38.5047 20 40 18.5047 40 16.6667V3.33333C40 1.49533 38.5047 0 36.6667 0H10C8.162 0 6.66667 1.49533 6.66667 3.33333V10.226C2.75067 11.912 0 15.8067 0 20.3333C0 24.8647 2.75533 28.7627 6.678 30.446C6.67691 30.4763 6.67481 30.5063 6.67272 30.5362L6.67271 30.5362C6.66969 30.5794 6.66667 30.6226 6.66667 30.6667C6.66667 34.71 9.95667 38 14 38C16.7653 38 19.2827 36.444 20.53 34H36.6667C36.8693 34 37.0607 33.908 37.1873 33.75L39.854 30.4167C39.9667 30.2753 40.0173 30.0953 39.9947 29.916C39.972 29.7367 39.8773 29.5747 39.7333 29.4667L37.0667 27.4667C36.9513 27.38 36.8113 27.3333 36.6667 27.3333H35.3333C35.1107 27.3333 34.9027 27.4447 34.7787 27.63L33.8967 28.9533L32.4713 27.528C32.3467 27.4033 32.1773 27.3333 32 27.3333H30.6667C30.298 27.3333 30 27.6313 30 28V29.3333H28.4807L27.966 27.7893C27.8747 27.5167 27.6207 27.3333 27.3333 27.3333H24.6667C24.444 27.3333 24.236 27.4447 24.112 27.63L23.3333 28.798L22.5547 27.63C22.4307 27.4447 22.2227 27.3333 22 27.3333H20.53C19.2827 24.8893 16.766 23.3333 14 23.3333C10.512 23.3333 7.59 25.7833 6.852 29.0513C3.59467 27.4947 1.33333 24.1773 1.33333 20.3333C1.33333 16.562 3.50933 13.2973 6.66667 11.7047V16.6667C6.66667 18.5047 8.162 20 10 20ZM8 11.1493C8.674 10.9287 9.37933 10.7793 10.1087 10.712C10.422 11.8353 11.444 12.6667 12.6667 12.6667C14.1373 12.6667 15.3333 11.4707 15.3333 10C15.3333 8.52933 14.1373 7.33333 12.6667 7.33333C11.4107 7.33333 10.3613 8.20867 10.08 9.38C9.36467 9.43933 8.67 9.56933 8 9.76V3.33333C8 2.23067 8.89733 1.33333 10 1.33333H36.6667C37.7693 1.33333 38.6667 2.23067 38.6667 3.33333V16.6667C38.6667 17.7693 37.7693 18.6667 36.6667 18.6667H10C8.89733 18.6667 8 17.7693 8 16.6667V11.1493ZM12.6667 8.66667C12.1753 8.66667 11.75 8.93667 11.5187 9.33333H12.6667V10.6667H11.5187C11.75 11.0633 12.1753 11.3333 12.6667 11.3333C13.402 11.3333 14 10.7353 14 10C14 9.26467 13.402 8.66667 12.6667 8.66667ZM11 30C10.9744 30 10.9494 29.9982 10.9243 29.9963C10.9017 29.9946 10.8791 29.993 10.856 29.9927C11.0887 29.6 11.512 29.3333 12 29.3333C12.7353 29.3333 13.3333 29.9313 13.3333 30.6667C13.3333 31.402 12.7353 32 12 32C11.506 32 11.078 31.7267 10.848 31.3253C10.8709 31.3259 10.8933 31.3276 10.9158 31.3292L10.9158 31.3292L10.9159 31.3292C10.9437 31.3313 10.9716 31.3333 11 31.3333H12V30H11ZM14.6667 30.6667C14.6667 32.1373 13.4707 33.3333 12 33.3333C10.7127 33.3333 9.63533 32.4167 9.38733 31.2013C8.91867 31.132 8.45933 31.0367 8.012 30.91C8.14133 34.1053 10.7733 36.6667 14 36.6667C16.3833 36.6667 18.5413 35.2533 19.4973 33.0667C19.6033 32.8233 19.8433 32.6667 20.108 32.6667H36.3467L38.3827 30.1207L36.4447 28.6667H35.69L34.5547 30.37C34.444 30.536 34.2647 30.644 34.066 30.6633C33.8647 30.682 33.67 30.6127 33.5287 30.4713L31.724 28.6667H31.3333V30C31.3333 30.3687 31.0353 30.6667 30.6667 30.6667H28C27.7127 30.6667 27.4587 30.4833 27.3673 30.2107L26.8527 28.6667H25.0233L23.888 30.37C23.6407 30.7413 23.026 30.7413 22.7787 30.37L21.6433 28.6667H20.108C19.8433 28.6667 19.6033 28.5093 19.4973 28.2667C18.5413 26.08 16.3833 24.6667 14 24.6667C11.0713 24.6667 8.62933 26.7773 8.10733 29.5567C8.54733 29.6953 9.00467 29.792 9.46933 29.8667C9.81133 28.7887 10.81 28 12 28C13.4707 28 14.6667 29.196 14.6667 30.6667Z"
                                        fill="currentColor" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M29.7 4H35.3C35.6871 4 36 4.298 36 4.66667V15.3333C36 15.702 35.6871 16 35.3 16H29.7C29.3129 16 29 15.702 29 15.3333V4.66667C29 4.298 29.3129 4 29.7 4ZM30.4 14.6667H34.6V5.33333H30.4V14.6667Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Сheck in hostel</h4>
                            <p class="main_text">Vulputate enim nulla aliquet porttitor. Sagittis nisl rhoncus mattis rhoncus</p>
                        </div>
                    </li>
                </ul>
                <div class="wrapper" data-aos="fade-up">
                    <a class="about_stages-main_btn btn theme-element theme-element--accent" href="#">Choose room</a>
                </div>
            </div>
            <div class="about_stages-media col-xl-6" data-aos="fade-in">
                <picture>
                    <source data-srcset="img/hero.webp" srcset="img/hero.webp" />
                    <img class="lazy" data-src="img/hero.webp" src="img/hero.webp" alt="media" />
                </picture>
            </div>
        </div>
    </section>
    <!-- stages section end -->
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
                                <source data-srcset="{{ $room->image ? asset($room->image) : url('asset/img/hero.webp') }}" srcset="{{ $room->image ? asset($room->image) : url('asset/img/hero.webp') }}" />
                                <img class="lazy" data-src="{{ $room->image ? asset($room->image) : url('asset/img/hero.webp') }}" src="{{ $room->image ? asset($room->image) : url('asset/img/hero.webp') }}" alt="media" />
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
                                See availability
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
    <!-- single room content start -->
</main>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/room.min.js') }}"></script>

<script>
        const bookings = document.querySelectorAll('button[type="submit"]');

        bookings.forEach((booking) => {
            booking.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                form.submit();
            });
        });
    </script>
@endpush