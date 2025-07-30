@extends('layouts.app')

@section('title', 'Home')

@php
$page = 'index';
@endphp

@section('content')
<!-- hero section start -->
<section class="hero section">
    <div class="container container--hero d-lg-flex align-items-center justify-content-between">
        <div class="hero_main">
            <h1 class="hero_main-title" data-aos="fade-up">{{ setting('hero_main_text', 'Hosteller — amazing hostel for the free spirited traveler') }}</h1>
            <div class="hero_main-content d-flex">
                <span class="line" data-aos="fade-up" data-aos-delay="50"></span>
                <p class="text" data-aos="fade-up" data-aos-delay="100">
                    Egestas pretium aenean pharetra magna ac. Et tortor consequat id porta nibh venenatis cras sed. Vel turpis
                    nunc eget lorem dolor sed
                </p>
            </div>
            <form class="booking" action="{{ route('booking.search') ?? '#' }}" method="post" autocomplete="off" data-type="booking" data-aos="fade-up">
                @csrf
                <div class="item-wrapper d-sm-flex flex-wrap flex-lg-nowrap align-items-lg-center">
                    <div class="booking_group d-flex flex-column">
                        <label class="booking_group-label h5" for="checkIn">Check-in</label>
                        <div class="booking_group-wrapper">
                            <i class="icon-calendar icon"></i>
                            <input
                                class="booking_group-field field required"
                                data-type="date"
                                data-start="true"
                                type="text"
                                id="checkIn"
                                name="check_in"
                                value="Add date"
                                readonly />
                            <i class="icon-chevron_down icon"></i>
                        </div>
                    </div>
                    <div class="booking_group d-flex flex-column">
                        <label class="booking_group-label h5" for="checkOut">Check-out</label>
                        <div class="booking_group-wrapper">
                            <i class="icon-calendar icon"></i>
                            <input
                                class="booking_group-field field required"
                                data-type="date"
                                data-end="true"
                                type="text"
                                id="checkOut"
                                name="check_out"
                                value="Add date"
                                readonly />
                            <i class="icon-chevron_down icon"></i>
                        </div>
                    </div>
                    <div class="booking_group d-flex flex-column">
                        <span class="booking_group-label h5">Guests</span>
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
                                        <label class="label h5" for="adults">Adults</label>
                                        <div class="main d-flex align-items-center justify-content-between">
                                            <a class="qty_minus qty-changer d-flex align-items-center justify-content-center" href="#" data-disabled="true"></a>
                                            <input class="field required" id="adults" name="adults" type="text" value="1" />
                                            <a class="qty_plus qty-changer d-flex align-items-center justify-content-center" href="#" data-disabled="">+</a>
                                        </div>
                                    </div>
                                    <div class="booking_group-dropdown_wrapper d-flex align-items-center justify-content-between">
                                        <label class="label h5" for="children">Children</label>
                                        <div class="main d-flex align-items-center justify-content-between">
                                            <a class="qty_minus qty-changer d-flex align-items-center justify-content-center" href="#" data-disabled=""></a>
                                            <input class="field required" id="children" name="children" type="text" value="0" />
                                            <a class="qty_plus qty-changer d-flex align-items-center justify-content-center" href="#" data-disabled="">+</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="booking_btn btn theme-element theme-element--accent" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="hero_media" data-aos="zoom-in">
            <picture>
                <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
            </picture>
        </div>
    </div>
</section>
<!-- hero section end -->

<!-- rooms section start -->
<section class="rooms section--blockbg section--nopb">
    <div class="block"></div>
    <div class="container">
        <div class="rooms_header d-sm-flex justify-content-between align-items-center">
            <h2 class="rooms_header-title" data-aos="fade-right">Hostel rooms</h2>
            <div class="wrapper" data-aos="fade-left">
                <a class="btn theme-element theme-element--light" href="{{ route('rooms.index') ?? 'rooms.html' }}">View all rooms</a>
            </div>
        </div>
        <ul class="rooms_list d-md-flex flex-wrap">
            @forelse($featuredRooms ?? [] as $index => $room)
            <li class="rooms_list-item col-md-6 col-xl-4 mb-4" data-order="{{ $index + 1 }}" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--pricing">
                            <span class="price h4">${{ $room->price ?? '18' }}</span>
                            / 1 night
                        </span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="{{ route('rooms.show', $room->id) ?? 'room.html' }}" data-shave="true">{{ $room->name ?? 'Bed in 6-Bed Room with Shared Bathroom' }}</a>
                        <div class="main_amenities">
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-user icon"></i>
                                {{ $room->capacity ?? '2' }} Sleeps
                            </span>
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-bunk_bed icon"></i>
                                {{ $room->bed_type ?? '1 bunk bed' }}
                            </span>
                        </div>
                        <a class="link link--arrow d-inline-flex align-items-center" href="#">
                            See availability
                            <i class="icon-arrow_right icon"></i>
                        </a>
                    </div>
                </div>
            </li>
            @empty
            <!-- Default room cards when no data available -->
            <li class="rooms_list-item col-md-6 col-xl-4" data-order="1" data-aos="fade-up">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--pricing">
                            <span class="price h4">$18</span>
                            / 1 night
                        </span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="room.html" data-shave="true">Bed in 6-Bed Room with Shared Bathroom</a>
                        <div class="main_amenities">
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-user icon"></i>
                                2 Sleeps
                            </span>
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-bunk_bed icon"></i>
                                1 bunk bed
                            </span>
                        </div>
                        <a class="link link--arrow d-inline-flex align-items-center" href="#">
                            See availability
                            <i class="icon-arrow_right icon"></i>
                        </a>
                    </div>
                </div>
            </li>
            <li class="rooms_list-item col-md-6 col-xl-4" data-order="2" data-aos="fade-up" data-aos-delay="50">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--pricing">
                            <span class="price h4">$35</span>
                            / 1 night
                        </span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="room.html" data-shave="true">Double Room with Private Bathroom</a>
                        <div class="main_amenities">
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-user icon"></i>
                                2 Sleeps
                            </span>
                            <span class="main_amenities-item d-inline-flex align-items-center">
                                <i class="icon-twin_bed icon"></i>
                                2 twin beds
                            </span>
                        </div>
                        <a class="link link--arrow d-inline-flex align-items-center" href="#">
                            See availability
                            <i class="icon-arrow_right icon"></i>
                        </a>
                    </div>
                </div>
            </li>
            @endforelse
            <!-- <li class="rooms_list-item col-md-6 col-xl-4" data-order="3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card accent">
                        <h3 class="title">Stay Longer, Save More</h3>
                        <p class="text">It's simple: the longer you stay, the more you save!</p>
                        <div class="content">
                            <p class="text">Save up to <b>30%</b> on daily rate for stays longer than 14 nights</p>
                            <p class="text">Save up to <b>20%</b> off the nightly rate on stays between 7-14 nights</p>
                        </div>
                        <a class="btn theme-element theme-element--light" href="{{ route('rooms.index') ?? 'rooms.html' }}">Choose room</a>
                    </div>
                </li> -->
        </ul>
    </div>
</section>
<!-- rooms section end -->

<!-- about section start -->
<section class="about section">
    <div class="container container--about d-xl-flex align-items-center">
        <div class="about_main">
            <h2 class="about_main-header" data-aos="fade-up">We have everything you need</h2>
            <p class="about_main-text" data-aos="fade-up">
                Posuere morbi leo urna molestie at elementum eu facilisis sed. Diam phasellus vestibulum lorem sed risus
                ultricies tristique
            </p>
            <ul class="about_main-list d-sm-flex flex-wrap">
                <li class="about_main-list_item d-flex flex-column flex-sm-row align-items-center" data-aos="fade-up" data-order="1">
                    <span class="icon">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 18.8178L6.08615 20C20.1515 8.74369 40.8485 8.74369 54.9138 20L56 18.8178C41.3088 7.06075 19.6912 7.06075 5 18.8178Z" fill="currentColor" />
                            <path d="M11 27.8499L12.212 29C22.595 19.1685 39.4049 19.1685 49.788 29L51 27.8499C39.9476 17.3834 22.0525 17.3834 11 27.8499Z" fill="currentColor" />
                            <path d="M18 36.5799L19.263 38C25.1969 31.3432 34.8031 31.3432 40.737 38L42 36.5799C35.3681 29.14 24.6319 29.14 18 36.5799Z" fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.3176 43.3159C29.0767 41.5614 31.9234 41.5614 33.6824 43.3159C35.4392 45.0737 35.4392 47.9232 33.6824 49.6812C31.9253 51.4393 29.076 51.4396 27.3184 49.682C25.5608 47.9243 25.5605 45.0741 27.3176 43.3159ZM28.5906 48.4085C29.645 49.4633 31.3553 49.4639 32.4105 48.4098C33.4632 47.354 33.4632 45.646 32.4105 44.5902C31.3558 43.5366 29.6465 43.5366 28.5918 44.5902C27.5366 45.6442 27.536 47.3537 28.5906 48.4085Z" fill="currentColor" />
                        </svg>
                    </span>
                    <p class="text">Free available high speed WiFi</p>
                </li>
                <li class="about_main-list_item d-flex flex-column flex-sm-row align-items-center" data-order="2" data-aos="fade-up" data-aos-delay="50">
                    <span class="icon">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13 21.6667C13 12.4769 20.8507 5 30.5 5C40.1493 5 48 12.4769 48 21.6666C48 24.4254 47.2758 27.1608 45.9043 29.5788L31.457 54.4629C31.2647 54.7945 30.8984 55 30.5 55C30.1016 55 29.7353 54.7945 29.543 54.4629L15.101 29.587C13.7242 27.1608 13 24.4255 13 21.6667ZM30.5 51.8059L43.9849 28.5789C45.1791 26.4742 45.8124 24.0806 45.8124 21.6667C45.8124 13.6254 38.9434 7.0834 30.5 7.0834C22.0566 7.0834 15.1876 13.6253 15.1876 21.6667C15.1876 24.0807 15.8209 26.4742 17.0204 28.5881L30.5 51.8059Z" fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M22 21.1764C22 16.5815 25.8132 12.8431 30.5 12.8431C35.1868 12.8431 39 16.5816 39 21.1765C39 25.7714 35.1868 29.5098 30.5 29.5098C25.8132 29.5098 22 25.7714 22 21.1764ZM24.125 21.1765C24.125 24.623 26.9846 27.4265 30.5 27.4265C34.0154 27.4265 36.875 24.6229 36.875 21.1765C36.875 17.73 34.0154 14.9265 30.5 14.9265C26.9846 14.9265 24.125 17.73 24.125 21.1765Z" fill="currentColor" />
                        </svg>
                    </span>
                    <p class="text">Convenient location in the center</p>
                </li>
                <li class="about_main-list_item d-flex flex-column flex-sm-row align-items-center" data-order="3" data-aos="fade-up" data-aos-delay="100">
                    <span class="icon">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M51.0582 15.7004H39.1938V13.5973C39.1941 12.907 38.9272 12.2452 38.4523 11.7585C37.9846 11.2768 37.3517 11.0043 36.6905 11H23.3095C22.6661 11.0003 22.0473 11.2554 21.5812 11.7125L21.531 11.7643C21.0561 12.251 20.7892 12.9128 20.7895 13.6031V15.7004H8.94179C6.7674 15.7068 5.00613 17.522 5 19.763V44.9374C5.00613 47.1784 6.7674 48.9937 8.94179 49V48.9943H51.0582C53.2305 48.9879 54.9908 47.1763 55 44.9374V19.763C54.9939 17.522 53.2326 15.7068 51.0582 15.7004ZM22.4286 13.5973C22.4296 13.3509 22.5259 13.1152 22.6963 12.9422L22.7241 12.9135C22.8846 12.7628 23.0925 12.677 23.3095 12.6722H36.6905C36.9287 12.6717 37.1574 12.7688 37.326 12.9422C37.4964 13.1152 37.5927 13.3509 37.5937 13.5973V15.6947H22.4286V13.5973ZM8.94179 47.3221H11.5065V17.3554H8.94179C7.65681 17.3617 6.61937 18.4387 6.62244 19.763V44.9374C6.63163 46.2527 7.66559 47.3158 8.94179 47.3221ZM16.3403 47.3221H13.1289L13.1345 35.7549H16.3403V47.3221ZM13.1289 34.031H16.3403V30.5832H13.1345L13.1289 34.031ZM16.3403 28.9341H13.1289L13.1345 17.3669H16.3403V28.9341ZM17.9628 47.3221H42.0372V17.3669H17.9683L17.9628 47.3221ZM46.8711 47.3221H43.6597V35.7434H46.8711V47.3221ZM43.6597 34.0195H46.8711V30.5718H43.6597V34.0195ZM46.8711 28.9341H43.6597V17.3554H46.8711V28.9341ZM51.0582 47.3278C52.3366 47.3215 53.3714 46.255 53.3776 44.9374V19.7458C53.3714 18.4282 52.3366 17.3617 51.0582 17.3554H48.4935V47.3278H51.0582Z" fill="currentColor" />
                        </svg>
                    </span>
                    <p class="text">Free storage of luggage of any size</p>
                </li>
                <li class="about_main-list_item d-flex flex-column flex-sm-row align-items-center" data-order="4" data-aos="fade-up" data-aos-delay="150">
                    <span class="icon">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M23.8125 17.6466H32.3944C36.9672 17.6466 40.6875 21.3669 40.6875 25.9395V26.2285C40.6875 30.8012 36.9672 34.5215 32.3944 34.5215H26.625V42.3535H23.8125V17.6466ZM32.3944 31.7091C35.4164 31.7091 37.875 29.2505 37.875 26.2286V25.9396C37.875 22.9177 35.4164 20.4591 32.3944 20.4591H26.625V31.7091H32.3944Z" fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M30 6C36.4106 6 42.4375 8.49638 46.9706 13.0294C51.5035 17.5625 54 23.5895 54 30C54 36.4105 51.5035 42.4375 46.9706 46.9706C42.4375 51.5036 36.4106 54 30 54C23.5894 54 17.5625 51.5035 13.0295 46.9705C8.49647 42.4375 6 36.4105 6 30C6 23.5895 8.49647 17.5625 13.0294 13.0294C17.5625 8.49638 23.5894 6 30 6ZM30 51.1875C35.6593 51.1875 40.98 48.9836 44.9819 44.9819C48.9836 40.98 51.1875 35.6593 51.1875 30C51.1875 24.3407 48.9836 19.02 44.9819 15.0181C40.98 11.0164 35.6593 8.8125 30 8.8125C24.3406 8.8125 19.02 11.0164 15.0182 15.0181C11.0164 19.02 8.8125 24.3407 8.8125 30C8.8125 35.6593 11.0164 40.98 15.0182 44.9818C19.02 48.9836 24.3406 51.1875 30 51.1875Z" fill="currentColor" />
                        </svg>
                    </span>
                    <p class="text">Parking place allocated to you</p>
                </li>
            </ul>
            <div class="about_main-action d-flex flex-column-reverse flex-sm-row align-items-center">
                <div class="wrapper" data-aos="fade-left">
                    <a class="about_main-action_item btn theme-element theme-element--accent" href="{{ route('rooms.index') ?? 'rooms.html' }}">Book now</a>
                </div>
                <div class="wrapper" data-aos="fade-left" data-aos-delay="50">
                    <a class="about_main-action_item link link--arrow" href="{{ route('about') ?? 'about.html' }}">
                        More about <i class="icon-arrow_right icon"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="about_media" data-aos="zoom-in">
            <picture>
                <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
            </picture>
            <a class="video-play d-inline-flex align-items-center justify-content-center" href="#">
                <i class="icon-play icon"></i>
            </a>
        </div>
    </div>
</section>
<!-- about section end -->

<!-- rating section start -->
<div class="rating">
    <div class="container">
        <ul class="rating_list d-flex flex-wrap">
            <li class="rating_list-item col-12 col-sm-6 col-xl-3" data-order="1" data-aos="zoom-in">
                <div class="main d-flex flex-column">
                    <span class="main_rating">
                        <span class="level h2">8.3</span>
                        <sup class="h4">/10</sup>
                    </span>
                    <span class="main_reviews">1398 comments</span>
                </div>
                <div class="media">
                    <svg width="193" height="32" viewBox="0 0 193 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M166.088 7.43665C166.124 7.39437 166.172 7.40318 166.219 7.40318C167.075 7.41727 167.934 7.3556 168.787 7.44723C169.634 7.53885 170.504 7.99872 170.726 9.01361C170.753 9.13343 170.796 9.24972 170.823 9.36953C170.851 9.49111 170.882 9.57392 171.025 9.42239C171.504 8.90966 172.004 8.41807 172.606 8.03925C173.425 7.52475 174.301 7.18469 175.274 7.05783C175.946 6.96973 176.611 6.98735 177.267 7.09131C178.937 7.35737 180.206 8.20311 180.996 9.69902C181.186 10.0585 181.204 10.0655 181.448 9.75012C182.138 8.85504 182.998 8.16787 184.027 7.68509C184.715 7.36265 185.437 7.16531 186.195 7.06135C186.889 6.96621 187.579 6.98735 188.26 7.08602C190.267 7.37322 191.715 8.38107 192.448 10.2963C192.738 11.054 192.875 11.8363 192.962 12.6327C192.966 12.6697 192.962 12.7102 193 12.7366C193 16.8227 193 20.9069 193 24.9929C192.142 24.9911 191.285 25.007 190.428 24.9823C189.735 24.9629 189.075 24.8114 188.599 24.2546C188.251 23.8511 188.097 23.3648 188.095 22.8468C188.082 20.1862 188.084 17.5257
        <!-- Booking.com SVG simplified for display -->
        <path d=" M166.088 7.43665C166.124 7.39437 166.172 7.40318 166.219 7.40318..." fill="#0094D0" />
                    </svg>
                </div>
            </li>
            <li class="rating_list-item col-12 col-sm-6 col-xl-3" data-order="2" data-aos="zoom-in">
                <div class="main d-flex flex-column">
                    <span class="main_rating">
                        <span class="level h2">4.6</span>
                        <sup class="h4">/5</sup>
                    </span>
                    <span class="main_reviews">460 notes</span>
                </div>
                <div class="media">
                    <svg width="214" height="30" viewBox="0 0 214 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- TripAdvisor logo simplified -->
                        <path d="M6.89014 5.36132C10.8566 4.84764 22.1106 4.49395 19.027 20.8106L22.5244 20.5251C20.9927 10.4679 24.197 5.33943 34.2164 4.84764C17.5986 -4.38605 8.13648 5.19964 6.89014 5.36132Z" fill="#FAC415" />
                    </svg>
                </div>
            </li>
            <li class="rating_list-item col-12 col-sm-6 col-xl-3" data-order="3" data-aos="zoom-in">
                <div class="main d-flex flex-column">
                    <span class="main_rating">
                        <span class="level h2">4.9</span>
                        <sup class="h4">/5</sup>
                    </span>
                    <span class="main_reviews">2389 notes</span>
                </div>
                <div class="media">
                    <svg width="98" height="32" viewBox="0 0 98 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Google logo simplified -->
                        <path d="M12.5646 21.3848C7.58395 21.3848 3.68499 17.367 3.68499 12.3863C3.68499 7.40565 7.58395 3.38782 12.5646 3.38782C15.2511 3.38782 17.2125 4.44577 18.6627 5.80089..." fill="#3686F7" />
                    </svg>
                </div>
            </li>
            <li class="rating_list-item col-12 col-sm-6 col-xl-3" data-order="4" data-aos="zoom-in">
                <div class="main d-flex flex-column">
                    <span class="main_rating">
                        <span class="level h2">98%</span>
                    </span>
                    <span class="main_reviews">2389 recommendations</span>
                </div>
                <div class="media">
                    <svg width="242" height="47" viewBox="0 0 242 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Hostelworld logo simplified -->
                        <path d="M0.734694 6.42905C1.38776 6.42905 1.91837 6.93412 1.91837 7.55574L2 23.5625C2 23.7956 2.20408 23.9899 2.44898 23.9899H7.10204..." fill="#86BC25" />
                    </svg>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- rating section end -->

<!-- reviews section start -->
<section class="reviews section">
    <div class="container d-lg-flex">
        <div class="media">
            <div class="reviews_slider reviews_slider--media">
                <div class="swiper-wrapper">
                    @forelse($reviews ?? [] as $review)
                    <div class="swiper-slide">
                        <picture>
                            <source data-srcset="{{ asset($review->image ?? 'img/placeholder.jpg') }}" srcset="{{ asset($review->image ?? 'img/placeholder.jpg') }}" />
                            <img class="lazy" data-src="{{ asset($review->image ?? 'img/placeholder.jpg') }}" src="{{ asset($review->image ?? 'img/placeholder.jpg') }}" alt="media" />
                        </picture>
                    </div>
                    @empty
                    <!-- Default review images -->
                    <div class="swiper-slide">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="main col-lg-6 d-lg-flex flex-column justify-content-between">
            <h2 class="reviews_header" data-aos="fade-down">What our guests say</h2>
            <div class="reviews_slider reviews_slider--main">
                <div class="swiper-wrapper">
                    @forelse($reviews ?? [] as $review)
                    <div class="reviews_slider-slide d-flex flex-column justify-content-between swiper-slide">
                        <div class="reviews_slider-slide_stars d-flex align-items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="icon-star icon {{ $i <= ($review->rating ?? 5) ? 'active' : '' }}"></i>
                                @endfor
                        </div>
                        <span class="reviews_slider-slide_date">
                            <span class="h4">Date of stay:</span>
                            {{ $review->date ?? 'July 2021' }}
                        </span>
                        <div class="reviews_slider-slide_main">
                            <h4 class="title">{{ $review->title ?? 'Very cozy room close to everything' }}</h4>
                            <p class="text">{{ $review->content ?? 'Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie at elementum eu facilisis sed. Diam phasellus vestibulum lorem sed risus ultricies tristique.' }}</p>
                        </div>
                        <span class="reviews_slider-slide_guest d-flex align-items-center">
                            <span class="avatar">
                                <picture>
                                    <source data-srcset="{{ asset($review->guest_avatar ?? 'img/placeholder.jpg') }}" srcset="{{ asset($review->guest_avatar ?? 'img/placeholder.jpg') }}" />
                                    <img class="lazy" data-src="{{ asset($review->guest_avatar ?? 'img/placeholder.jpg') }}" src="{{ asset($review->guest_avatar ?? 'img/placeholder.jpg') }}" alt="media" />
                                </picture>
                            </span>
                            <span class="name h6">{{ $review->guest_name ?? 'Betty Randal' }}</span>
                        </span>
                    </div>
                    @empty
                    <!-- Default reviews -->
                    <div class="reviews_slider-slide d-flex flex-column justify-content-between swiper-slide">
                        <div class="reviews_slider-slide_stars d-flex align-items-center">
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                        </div>
                        <span class="reviews_slider-slide_date">
                            <span class="h4">Date of stay:</span>
                            July 2021
                        </span>
                        <div class="reviews_slider-slide_main">
                            <h4 class="title">Very cozy room close to everything</h4>
                            <p class="text">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie
                                at elementum eu facilisis sed. Diam phasellus vestibulum lorem sed risus ultricies tristique.
                            </p>
                        </div>
                        <span class="reviews_slider-slide_guest d-flex align-items-center">
                            <span class="avatar">
                                <picture>
                                    <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                                </picture>
                            </span>
                            <span class="name h6">Betty Randal</span>
                        </span>
                    </div>
                    <div class="reviews_slider-slide d-flex flex-column justify-content-between swiper-slide">
                        <div class="reviews_slider-slide_stars d-flex align-items-center">
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                        </div>
                        <span class="reviews_slider-slide_date">
                            <span class="h4">Date of stay:</span>
                            October 2021
                        </span>
                        <div class="reviews_slider-slide_main">
                            <h4 class="title">Consequat interdum varius sit varius</h4>
                            <p class="text">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie
                                at elementum eu facilisis sed. Diam phasellus vestibulum lorem sed risus ultricies tristique.
                            </p>
                        </div>
                        <span class="reviews_slider-slide_guest d-flex align-items-center">
                            <span class="avatar">
                                <picture>
                                    <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                                </picture>
                            </span>
                            <span class="name h6">Max Jones</span>
                        </span>
                    </div>
                    <div class="reviews_slider-slide d-flex flex-column justify-content-between swiper-slide">
                        <div class="reviews_slider-slide_stars d-flex align-items-center">
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                        </div>
                        <span class="reviews_slider-slide_date">
                            <span class="h4">Date of stay:</span>
                            December 2021
                        </span>
                        <div class="reviews_slider-slide_main">
                            <h4 class="title">Diam sit molestie at elementum eu</h4>
                            <p class="text">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie
                                at elementum eu facilisis sed. Diam phasellus vestibulum lorem sed risus ultricies tristique.
                            </p>
                        </div>
                        <span class="reviews_slider-slide_guest d-flex align-items-center">
                            <span class="avatar">
                                <picture>
                                    <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                                </picture>
                            </span>
                            <span class="name h6">Kate Walker</span>
                        </span>
                    </div>
                    <div class="reviews_slider-slide d-flex flex-column justify-content-between swiper-slide">
                        <div class="reviews_slider-slide_stars d-flex align-items-center">
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                        </div>
                        <span class="reviews_slider-slide_date">
                            <span class="h4">Date of stay:</span>
                            April 2021
                        </span>
                        <div class="reviews_slider-slide_main">
                            <h4 class="title">Elementum eu facilisis at elementum</h4>
                            <p class="text">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie
                                at elementum eu facilisis sed. Diam phasellus vestibulum lorem sed risus ultricies tristique.
                            </p>
                        </div>
                        <span class="reviews_slider-slide_guest d-flex align-items-center">
                            <span class="avatar">
                                <picture>
                                    <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                                </picture>
                            </span>
                            <span class="name h6">Panam Palmer</span>
                        </span>
                    </div>
                    <div class="reviews_slider-slide d-flex flex-column justify-content-between swiper-slide">
                        <div class="reviews_slider-slide_stars d-flex align-items-center">
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                            <i class="icon-star icon"></i>
                        </div>
                        <span class="reviews_slider-slide_date">
                            <span class="h4">Date of stay:</span>
                            May 2021
                        </span>
                        <div class="reviews_slider-slide_main">
                            <h4 class="title">Ultricies eu ultricies tristique facilisis</h4>
                            <p class="text">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie
                                at elementum eu facilisis sed. Diam phasellus vestibulum lorem sed risus ultricies tristique.
                            </p>
                        </div>
                        <span class="reviews_slider-slide_guest d-flex align-items-center">
                            <span class="avatar">
                                <picture>
                                    <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                                    <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                                </picture>
                            </span>
                            <span class="name h6">Lisa Adams</span>
                        </span>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="swiper-controls d-flex align-items-center">
                <a class="swiper-button-prev d-inline-flex theme-element theme-element--light" href="#">
                    <i class="icon-arrow_left icon"></i>
                </a>
                <a class="swiper-button-next d-inline-flex theme-element theme-element--light" href="#">
                    <i class="icon-arrow_right icon"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- reviews section end -->

<!-- promo section start -->
<section class="promo section">
    <div class="container">
        <div class="container d-xl-flex align-items-center justify-content-between">
            <div class="promo_info">
                <h2 class="info_header" data-aos="fade-up">Find suitable budget accommodation</h2>
                <p class="info_text" data-aos="fade-up" data-aos-delay="50">
                    Condimentum id venenatis a condimentum vitae sapien pellentesque habitant. At augue eget arcu dictum varius
                    duis at consectetur
                </p>
                <ul class="info_list">
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up">
                        <div class="media theme-element theme-element--accent">
                            <svg width="40" height="38" viewBox="0 0 40 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.14272 37.5001H30.857C31.1726 37.5001 31.4284 37.2495 31.4284 36.9404V3.35829C31.4284 3.04917 31.1726 2.79858 30.857 2.79858H9.14272C8.82713 2.79858 8.57129 3.04917 8.57129 3.35829V36.9404C8.57129 37.2495 8.82713 37.5001 9.14272 37.5001ZM30.2856 36.3807H9.71415V3.91799H30.2856V36.3807Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7145 3.91791H26.2859C26.6015 3.91791 26.8574 3.66732 26.8574 3.35821V0.559702C26.8574 0.250587 26.6015 0 26.2859 0H13.7145C13.3989 0 13.1431 0.250587 13.1431 0.559702V3.35821C13.1431 3.66732 13.3989 3.91791 13.7145 3.91791ZM25.7145 2.79851H14.2859V1.1194H25.7145V2.79851Z" fill="currentColor" />
                            </svg>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Hostel territory</h4>
                            <p class="main_text">Consequat interdum varius sit amet mattis</p>
                        </div>
                    </li>
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="50">
                        <div class="media theme-element theme-element--accent">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M35.5133 23.6979L35.3079 23.8084C34.4779 22.8045 33.0399 22.4154 31.9444 22.9688L31.9327 22.9748L31.4477 23.2351C30.2625 22.2348 28.5752 22.0828 27.2293 22.8552L24.6173 24.2712H21.1416C20.389 24.2702 19.6463 24.1006 18.9683 23.7748L18.4902 23.5443C15.7145 22.1981 12.4156 22.5193 9.95364 24.3753C9.94229 24.384 9.9312 24.3926 9.92064 24.4024L8.76626 25.4267C8.33 25.8129 7.81433 26.0994 7.25535 26.2662L6.59973 24.121C6.53304 23.903 6.33126 23.754 6.10262 23.754H0.519728C0.370932 23.754 0.229272 23.8176 0.130628 23.9286C0.0319839 24.0397 -0.0141828 24.1875 0.00382146 24.3348L1.86476 39.5445C1.89654 39.8045 2.11795 39.9999 2.38066 39.9999H10.7545C10.9192 39.9999 11.0742 39.9221 11.1722 39.7901C11.2702 39.6582 11.2997 39.4878 11.2516 39.3307L10.1516 35.7326L13.5777 33.5741C14.0361 33.3212 14.574 33.2519 15.0819 33.3801C15.0926 33.3827 15.1034 33.3852 15.1143 33.3871L22.0837 34.6663C23.9777 35.0041 25.9304 34.7293 27.6565 33.882C27.6786 33.8711 27.6998 33.8587 27.7201 33.8448L39.7744 25.5948C40.0011 25.4397 40.0673 25.1354 39.9255 24.9005C39.0143 23.3878 37.07 22.8579 35.5133 23.6979Z" fill="currentColor" />
                            </svg>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Accommodates guests</h4>
                            <p class="main_text">Consequat interdum varius sit amet mattis</p>
                        </div>
                    </li>
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="media theme-element theme-element--accent">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.3333 19.3333V25.4006C26.8527 25.7106 28 27.0573 28 28.6666V32.6666V39.3333C28 39.7013 27.7013 39.9999 27.3333 39.9999H24.6667C24.2987 39.9999 24 39.7013 24 39.3333V37.3333H4V39.3333C4 39.7013 3.70133 39.9999 3.33333 39.9999H0.666667C0.298667 39.9999 0 39.7013 0 39.3333V32.6666V28.6666C0 27.0573 1.14733 25.7106 2.66667 25.4006V19.3333C2.66667 18.2306 3.564 17.3333 4.66667 17.3333H23.3333C24.436 17.3333 25.3333 18.2306 25.3333 19.3333Z" fill="currentColor" />
                            </svg>
                        </div>
                        <div class="main">
                            <h4 class="main_title">Grateful guests</h4>
                            <p class="main_text">Consequat interdum varius sit amet mattis</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="promo_media" data-aos="fade-up">
                <picture>
                    <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                    <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                </picture>
                <div class="media_card media_card--top" data-aos="fade-left">
                    <h4 class="media_card-text">This is the perfect hostel for a weekend getaway!</h4>
                    <div class="media_card-footer d-flex align-items-center">
                        <span class="avatar">
                            <picture>
                                <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                                <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
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
                <div class="media_card media_card--bottom" data-aos="fade-right">
                    <h4 class="media_card-text">Family Room with Private Bathroom</h4>
                    <div class="media_card-pricing"><span class="h2">$149</span> / 1 night</div>
                    <a class="media_card-btn btn theme-element theme-element--light" href="#">See availability</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- promo section end -->

<!-- gallery section start -->
<section class="gallery section">
    <div class="container">
        <div class="gallery_header d-sm-flex justify-content-between align-items-center">
            <h2 class="gallery_header-title">Photos of our rooms</h2>
            <div class="wrapper">
                <a class="btn theme-element theme-element--light" href="{{ route('gallery') ?? 'gallery.html' }}">View all photos</a>
            </div>
        </div>
        <div class="gallery_grid d-grid">
            @forelse($galleryImages ?? [] as $index => $image)
            <div class="gallery_grid-item {{ $index === 0 ? 'gallery_grid-item--left' : ($index === 2 ? 'gallery_grid-item--right' : '') }}" data-aos="zoom-in">
                <a href="{{ asset($image->url ?? 'img/placeholder.jpg') }}" data-caption="{{ $image->caption ?? 'Image caption' }}" data-role="gallery-link">
                    <picture>
                        <source data-srcset="{{ asset($image->url ?? 'img/placeholder.jpg') }}" srcset="{{ asset($image->url ?? 'img/placeholder.jpg') }}" />
                        <img class="gallery_grid-item_img lazy" data-src="{{ asset($image->url ?? 'img/placeholder.jpg') }}" src="{{ asset($image->url ?? 'img/placeholder.jpg') }}" alt="media" />
                    </picture>
                    <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="overlay_focus">
                            <svg width="105" height="106" viewBox="0 0 105 106" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M103.514 28.944C102.693 28.944 102.028 28.2795 102.028 27.4598V3.712H78.2507C77.43 3.712 76.7646 3.04749 76.7646 2.22777C76.7646 1.40805 77.43 0.74353 78.2507 0.74353H103.514C104.335 0.74353 105 1.40805 105 2.22777V27.4598C105 28.2795 104.335 28.944 103.514 28.944Z" fill="currentColor" />
                                <path d="M26.7492 105.614H1.48607C0.665335 105.614 0 104.95 0 104.13V78.8978C0 78.0781 0.665335 77.4136 1.48607 77.4136C2.3068 77.4136 2.97214 78.0781 2.97214 78.8978V102.646H26.7492C27.57 102.646 28.2353 103.31 28.2353 104.13C28.2353 104.95 27.57 105.614 26.7492 105.614Z" fill="currentColor" />
                                <path d="M1.48607 28.944C0.665335 28.944 0 28.2795 0 27.4598V2.22777C0 1.40805 0.665335 0.74353 1.48607 0.74353H26.7492C27.57 0.74353 28.2353 1.40805 28.2353 2.22777C28.2353 3.04749 27.57 3.712 26.7492 3.712H2.97214V27.4598C2.97214 28.2795 2.3068 28.944 1.48607 28.944Z" fill="currentColor" />
                                <path d="M103.514 105.614H78.2507C77.43 105.614 76.7646 104.95 76.7646 104.13C76.7646 103.31 77.43 102.646 78.2507 102.646H102.028V78.8978C102.028 78.0781 102.693 77.4136 103.514 77.4136C104.335 77.4136 105 78.0781 105 78.8978V104.13C105 104.95 104.335 105.614 103.514 105.614Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <!-- Default gallery images -->
            <div class="gallery_grid-item gallery_grid-item--left" data-aos="zoom-in">
                <a href="{{ asset('img/hero.webp') }}" data-caption="Image caption" data-role="gallery-link">
                    <picture>
                        <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                        <img class="gallery_grid-item_img lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                    </picture>
                    <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="overlay_focus">
                            <svg width="105" height="106" viewBox="0 0 105 106" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M103.514 28.944C102.693 28.944 102.028 28.2795 102.028 27.4598V3.712H78.2507C77.43 3.712 76.7646 3.04749 76.7646 2.22777C76.7646 1.40805 77.43 0.74353 78.2507 0.74353H103.514C104.335 0.74353 105 1.40805 105 2.22777V27.4598C105 28.2795 104.335 28.944 103.514 28.944Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery_grid-item" data-aos="zoom-in">
                <a href="{{ asset('img/hero.webp') }}" data-caption="Image caption" data-role="gallery-link">
                    <picture>
                        <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                        <img class="gallery_grid-item_img lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                    </picture>
                    <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="overlay_focus">
                            <svg width="105" height="106" viewBox="0 0 105 106" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M103.514 28.944C102.693 28.944 102.028 28.2795 102.028 27.4598V3.712H78.2507C77.43 3.712 76.7646 3.04749 76.7646 2.22777C76.7646 1.40805 77.43 0.74353 78.2507 0.74353H103.514C104.335 0.74353 105 1.40805 105 2.22777V27.4598C105 28.2795 104.335 28.944 103.514 28.944Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery_grid-item gallery_grid-item--right" data-aos="zoom-in">
                <a href="{{ asset('img/hero.webp') }}" data-caption="Image caption" data-role="gallery-link">
                    <picture>
                        <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                        <img class="gallery_grid-item_img lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                    </picture>
                    <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="overlay_focus">
                            <svg width="105" height="106" viewBox="0 0 105 106" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M103.514 28.944C102.693 28.944 102.028 28.2795 102.028 27.4598V3.712H78.2507C77.43 3.712 76.7646 3.04749 76.7646 2.22777C76.7646 1.40805 77.43 0.74353 78.2507 0.74353H103.514C104.335 0.74353 105 1.40805 105 2.22777V27.4598C105 28.2795 104.335 28.944 103.514 28.944Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery_grid-item" data-aos="zoom-in">
                <a href="{{ asset('img/hero.webp') }}" data-caption="Image caption" data-role="gallery-link">
                    <picture>
                        <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                        <img class="gallery_grid-item_img lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                    </picture>
                    <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="overlay_focus">
                            <svg width="105" height="106" viewBox="0 0 105 106" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M103.514 28.944C102.693 28.944 102.028 28.2795 102.028 27.4598V3.712H78.2507C77.43 3.712 76.7646 3.04749 76.7646 2.22777C76.7646 1.40805 77.43 0.74353 78.2507 0.74353H103.514C104.335 0.74353 105 1.40805 105 2.22777V27.4598C105 28.2795 104.335 28.944 103.514 28.944Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            @endforelse
        </div>
    </div>
</section>
<!-- gallery section end -->

<!-- news section start -->
<section class="latest section section--blockbg">
    <div class="block"></div>
    <div class="container">
        <div class="latest_header d-sm-flex justify-content-between align-items-center">
            <h2 class="latest_header-title" data-aos="fade-right">Hosteller news</h2>
            <div class="wrapper" data-aos="fade-left">
                <a class="btn theme-element theme-element--light" href="{{ '' ?? 'news.html' }}">View all news</a>
            </div>
        </div>
        <ul class="latest_list d-md-flex flex-wrap">
            @forelse($latestNews ?? [] as $index => $article)
            <li class="latest_list-item col-md-6 col-xl-4" data-order="{{ $index + 1 }}" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ asset($article->image ?? 'img/placeholder.jpg') }}" srcset="{{ asset($article->image ?? 'img/placeholder.jpg') }}" />
                            <img class="lazy" data-src="{{ asset($article->image ?? 'img/placeholder.jpg') }}" src="{{ asset($article->image ?? 'img/placeholder.jpg') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--left">{{ $article->category ?? 'Travel' }}</span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="{{ route('news.show', $article->id) ?? '#' }}" data-shave="true">{{ $article->title ?? 'How to cure wanderlust without leaving your home' }}</a>
                        <p class="main_preview">{{ $article->excerpt ?? 'Ultrices gravida dictum fusce ut placer orci nulla pellentesque. Senect et netus et malesuada' }}</p>
                        <div class="main_metadata">
                            <span class="main_metadata-item d-inline-flex align-items-center">
                                <i class="icon-calendar icon"></i>
                                {{ $article->published_at ? $article->published_at->format('F j, Y') : 'June 16, 2021' }}
                            </span>
                            <span class="main_metadata-item d-inline-flex align-items-center">
                                <i class="icon-eye icon"></i>
                                <span class="number">{{ $article->views ?? '120' }}</span>
                                <span class="text">views</span>
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <!-- Default news articles -->
            <li class="latest_list-item col-md-6 col-xl-4" data-order="1" data-aos="fade-up">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--left">Travel</span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="#" data-shave="true">How to cure wanderlust without leaving your home</a>
                        <p class="main_preview">
                            Ultrices gravida dictum fusce ut placer orci nulla pellentesque. Senect et netus et malesuada
                        </p>
                        <div class="main_metadata">
                            <span class="main_metadata-item d-inline-flex align-items-center">
                                <i class="icon-calendar icon"></i>
                                June 16, 2021
                            </span>
                            <span class="main_metadata-item d-inline-flex align-items-center">
                                <i class="icon-eye icon"></i>
                                <span class="number">120</span>
                                <span class="text">views</span>
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            <li class="latest_list-item col-md-6 col-xl-4" data-order="2" data-aos="fade-up" data-aos-delay="50">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--left">Tourist Guide</span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="#" data-shave="true">Yoga Hostels to soothe your mind and nomadic soul</a>
                        <p class="main_preview">
                            Ultrices gravida dictum fusce ut placer orci nulla pellentesque. Senect et netus et malesuada
                        </p>
                        <div class="main_metadata">
                            <span class="main_metadata-item d-inline-flex align-items-center">
                                <i class="icon-calendar icon"></i>
                                June 16, 2021
                            </span>
                            <span class="main_metadata-item d-inline-flex align-items-center">
                                <i class="icon-eye icon"></i>
                                <span class="number">120</span>
                                <span class="text">views</span>
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            <li class="latest_list-item col-md-6 col-xl-4" data-order="3" data-aos="fade-up" data-aos-delay="100">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <picture>
                            <source data-srcset="{{ asset('img/hero.webp') }}" srcset="{{ asset('img/hero.webp') }}" />
                            <img class="lazy" data-src="{{ asset('img/hero.webp') }}" src="{{ asset('img/hero.webp') }}" alt="media" />
                        </picture>
                        <span class="media_label media_label--left">Communication</span>
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="#" data-shave="true">What happens when you travel with strangers?</a>
                        <p class="main_preview">
                            Euismod quis viverra nibh cras pulvinar mattis nunc. Leo duis ut diam quam. Sed velit dignissim
                        </p>
                        <div class="main_metadata">
                            <span class="main_metadata-item d-inline-flex align-items-center">
                                <i class="icon-calendar icon"></i>
                                June 16, 2021
                            </span>
                            <span class="main_metadata-item d-inline-flex align-items-center">
                                <i class="icon-eye icon"></i>
                                <span class="number">120</span>
                                <span class="text">views</span>
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</section>
<!-- news section end -->

<!-- contacts section start -->
<section class="contacts section">
    <div class="container container--contacts d-xl-flex align-items-center">
        <div class="contacts_info">
            <div class="contacts_info-header">
                <h2 class="contacts_info-header_title" data-aos="fade-down">Contacts</h2>
                <p class="contacts_info-header_text" data-aos="fade-up">
                    Egestas pretium aenean pharetra magna ac. Et tortor consequat id porta nibh venenatis cras sed
                </p>
            </div>
            <ul class="contacts_info-list col-xl-7 d-md-flex flex-wrap">
                <li class="contacts_info-list_item col-md-6 d-flex align-items-center" data-order="1" data-aos="fade-up">
                    <span class="theme-element theme-element--light media">
                        <span class="icon-call icon">
                            <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.9609 19.75L21 17.1797C20.7812 17.125 20.5625 17.0703 20.3438 17.0703C19.7969 17.0703 19.3047 17.2891 19.0312 17.6719L16.625 20.625C12.7969 18.7656 9.73438 15.7031 7.875 11.875L10.8281 9.46875C11.2109 9.19531 11.4297 8.70312 11.4297 8.15625C11.4297 7.9375 11.375 7.71875 11.3203 7.5L8.75 1.53906C8.47656 0.9375 7.875 0.5 7.21875 0.5C7.05469 0.5 6.94531 0.554688 6.83594 0.554688L1.3125 1.86719C0.546875 2.03125 0 2.6875 0 3.50781C0 17.3438 11.2109 28.5 24.9922 28.5C25.8125 28.5 26.4688 27.9531 26.6875 27.1875L27.9453 21.6641C27.9453 21.5547 27.9453 21.4453 27.9453 21.2812C27.9453 20.625 27.5625 20.0234 26.9609 19.75ZM24.9375 26.75C12.1406 26.75 1.75 16.3594 1.75 3.5625L7.16406 2.30469L9.67969 8.15625L5.6875 11.4375C8.36719 17.0703 11.4297 20.1328 17.1172 22.8125L20.3438 18.8203L26.1953 21.3359L24.9375 26.75Z" fill="currentColor" />
                            </svg>
                        </span>
                    </span>
                    <div class="main d-flex flex-column">
                        <h4 class="main_title">Phone</h4>
                        <a class="link" href="tel:{{ config('contact.phone.primary', '+1234567890') }}">{{ config('contact.phone.primary', '(329) 580-7077') }}</a>
                        <a class="link" href="tel:{{ config('contact.phone.secondary', '+1234567890') }}">{{ config('contact.phone.secondary', '(650) 382-5020') }}</a>
                    </div>
                </li>
                <li class="contacts_info-list_item col-md-6 d-flex align-items-center" data-order="2" data-aos="fade-up">
                    <span class="theme-element theme-element--light media">
                        <i class="icon-email icon"></i>
                    </span>
                    <div class="main d-flex flex-column">
                        <h4 class="main_title">Email</h4>
                        <a class="link" href="mailto:{{ config('contact.email.primary', 'contact@example.com') }}">{{ config('contact.email.primary', 'contact@example.com') }}</a>
                        <a class="link" href="mailto:{{ config('contact.email.secondary', 'contact@example.com') }}">{{ config('contact.email.secondary', 'contact@example.com') }}</a>
                    </div>
                </li>
                <li class="contacts_info-list_item col-md-6 d-flex align-items-center" data-order="3" data-aos="fade-up">
                    <span class="theme-element theme-element--light media">
                        <i class="icon-location icon"></i>
                    </span>
                    <div class="main d-flex flex-column">
                        <h4 class="main_title">Location</h4>
                        <span>{{ config('contact.address.line1', '54826 Fadel Circles') }}</span>
                        <span>{{ config('contact.address.line2', 'Darrylstad, AZ 90995') }}</span>
                    </div>
                </li>
                <li class="contacts_info-list_item col-md-6 d-flex align-items-center" data-order="4" data-aos="fade-up">
                    <span class="theme-element theme-element--light media">
                        <i class="icon-clock icon"></i>
                    </span>
                    <div class="main d-flex flex-column">
                        <h4 class="main_title">Working Time</h4>
                        <span>{{ config('contact.hours.days', 'Everyday') }}</span>
                        <span>{{ config('contact.hours.time', '10 am — 20 pm') }}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="contacts_map">
            <div id="map"></div>
        </div>
    </div>
</section>
<!-- contacts section end -->

<!-- Video popup overlay -->
<div class="video d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="video_frame d-flex align-items-center justify-content-center">
            <i class="icon-close video_frame-close"></i>
            <div id="player"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/index.min.js') }}"></script>
<script src="{{ asset('asset/js/gallery.min.js') }}"></script>
@endpush