@extends('layouts.app')

@section('title', $room->name)

@php
    $page = 'room';
@endphp

@section('content')
    <header class="page">
        <div class="container">
            <div class="page_header">
                <h1 class="page_header-title" data-aos="fade-up">{{ $room->name }}</h1>
                <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                    {{ $room->short_description }}
                </p>
            </div>
        </div>
    </header>

    <section class="room section">
        <div class="container">
            <div class="room_main d-lg-flex">
                <div class="room_main-content">
                    <div class="room_main-content_gallery">
                        <div class="room_main-content_gallery-main" data-aos="fade-up">
                            <img class="room_main-content_gallery-main_img" src="{{ asset($room->main_image) }}" alt="{{ $room->name }}" />
                        </div>
                        @if($room->images->count() > 0)
                        <div class="room_main-content_gallery-thumbs">
                            @foreach($room->images->take(4) as $image)
                            <div class="room_main-content_gallery-thumbs_item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                <img class="room_main-content_gallery-thumbs_item_img" src="{{ asset($image['path']) }}" alt="{{ $room->name }}" />
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <div class="room_main-content_info">
                        <div class="room_main-content_info_header d-flex align-items-center justify-content-between">
                            <h2 class="room_main-content_info_header-title" data-aos="fade-up">{{ $room->name }}</h2>
                            <div class="room_main-content_info_header_rating" data-aos="fade-up">
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="icon-star {{ $i <= $room->rating ? 'filled' : 'empty' }}"></i>
                                    @endfor
                                </div>
                                <span class="room_main-content_info_header_rating-text">{{ $room->rating }}/5</span>
                            </div>
                        </div>

                        <div class="room_main-content_info_description" data-aos="fade-up">
                            <p>{{ $room->description }}</p>
                        </div>

                        <div class="room_main-content_info_features">
                            <h3 class="room_main-content_info_features-title" data-aos="fade-up">Room Features</h3>
                            <ul class="room_main-content_info_features-list">
                                @foreach($room->amenities as $amenity)
                                <li class="list-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                    <i class="icon-{{ $amenity->icon }} icon"></i>
                                    <span>{{ $amenity->name }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="room_main-content_info_details">
                            <h3 class="room_main-content_info_details-title" data-aos="fade-up">Room Details</h3>
                            <div class="room_main-content_info_details-grid">
                                <div class="room_main-content_info_details-grid_item" data-aos="fade-up">
                                    <span class="label">Room Type:</span>
                                    <span class="value">{{ $room->type }}</span>
                                </div>
                                <div class="room_main-content_info_details-grid_item" data-aos="fade-up">
                                    <span class="label">Capacity:</span>
                                    <span class="value">{{ $room->capacity }} {{ Str::plural('person', $room->capacity) }}</span>
                                </div>
                                <div class="room_main-content_info_details-grid_item" data-aos="fade-up">
                                    <span class="label">Size:</span>
                                    <span class="value">{{ $room->size }} m²</span>
                                </div>
                                <div class="room_main-content_info_details-grid_item" data-aos="fade-up">
                                    <span class="label">Beds:</span>
                                    <span class="value">{{ $room->beds }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($room->reviews->count() > 0)
                    <div class="room_main-content_reviews">
                        <h3 class="room_main-content_reviews-title" data-aos="fade-up">Guest Reviews</h3>
                        <div class="room_main-content_reviews_list">
                            @foreach($room->reviews->take(3) as $review)
                            <div class="room_main-content_reviews_list-item" data-aos="fade-up">
                                <div class="room_main-content_reviews_list-item_header">
                                    <div class="room_main-content_reviews_list-item_header_author">
                                        <img class="room_main-content_reviews_list-item_header_author_avatar" src="{{ asset($review->user->avatar ?? 'img/default-avatar.jpg') }}" alt="{{ $review->user->name }}" />
                                        <div class="room_main-content_reviews_list-item_header_author_info">
                                            <h4 class="room_main-content_reviews_list-item_header_author_info_name">{{ $review->user->name }}</h4>
                                            <div class="room_main-content_reviews_list-item_header_author_info_rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="icon-star {{ $i <= $review->rating ? 'filled' : 'empty' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <span class="room_main-content_reviews_list-item_header_date">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                                <p class="room_main-content_reviews_list-item_text">{{ $review->comment }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="room_main-sidebar">
                    <div class="room_main-sidebar_booking" data-aos="fade-left">
                        <div class="room_main-sidebar_booking_header">
                            <h3 class="room_main-sidebar_booking_header-title">Book This Room</h3>
                            <div class="room_main-sidebar_booking_header_price">
                                <span class="currency">$</span>
                                <span class="amount">{{ $room->price }}</span>
                                <span class="period">/night</span>
                            </div>
                        </div>

                        <form class="room_main-sidebar_booking_form" action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            
                            <div class="room_main-sidebar_booking_form-group">
                                <label class="room_main-sidebar_booking_form-group_label" for="checkIn">Check-in</label>
                                <div class="room_main-sidebar_booking_form-group_wrapper">
                                    <i class="icon-calendar icon"></i>
                                    <input
                                        class="room_main-sidebar_booking_form-group_field field required"
                                        type="text"
                                        id="checkIn"
                                        name="check_in"
                                        value="{{ request('check_in', 'Add date') }}"
                                        readonly
                                    />
                                    <i class="icon-chevron_down icon"></i>
                                </div>
                            </div>

                            <div class="room_main-sidebar_booking_form-group">
                                <label class="room_main-sidebar_booking_form-group_label" for="checkOut">Check-out</label>
                                <div class="room_main-sidebar_booking_form-group_wrapper">
                                    <i class="icon-calendar icon"></i>
                                    <input
                                        class="room_main-sidebar_booking_form-group_field field required"
                                        type="text"
                                        id="checkOut"
                                        name="check_out"
                                        value="{{ request('check_out', 'Add date') }}"
                                        readonly
                                    />
                                    <i class="icon-chevron_down icon"></i>
                                </div>
                            </div>

                            <div class="room_main-sidebar_booking_form-group">
                                <label class="room_main-sidebar_booking_form-group_label" for="guests">Guests</label>
                                <div class="room_main-sidebar_booking_form-group_wrapper">
                                    <i class="icon-user icon"></i>
                                    <input
                                        class="room_main-sidebar_booking_form-group_field field required"
                                        type="text"
                                        id="guests"
                                        name="guests"
                                        value="{{ request('guests', '1 Guest') }}"
                                        readonly
                                    />
                                    <i class="icon-chevron_down icon"></i>
                                </div>
                            </div>

                            <div class="room_main-sidebar_booking_form-group">
                                <label class="room_main-sidebar_booking_form-group_label" for="nights">Nights</label>
                                <div class="room_main-sidebar_booking_form-group_wrapper">
                                    <i class="icon-calendar icon"></i>
                                    <input
                                        class="room_main-sidebar_booking_form-group_field field"
                                        type="text"
                                        id="nights"
                                        name="nights"
                                        value="1"
                                        readonly
                                    />
                                </div>
                            </div>

                            <div class="room_main-sidebar_booking_form-total">
                                <div class="room_main-sidebar_booking_form-total_item">
                                    <span class="label">Price per night:</span>
                                    <span class="value">${{ $room->price }}</span>
                                </div>
                                <div class="room_main-sidebar_booking_form-total_item">
                                    <span class="label">Total:</span>
                                    <span class="value total">${{ $room->price }}</span>
                                </div>
                            </div>

                            <button class="room_main-sidebar_booking_form-submit" type="submit">
                                <span class="room_main-sidebar_booking_form-submit-text">Book Now</span>
                                <i class="icon-arrow_right icon"></i>
                            </button>
                        </form>
                    </div>

                    <div class="room_main-sidebar_contact" data-aos="fade-left" data-aos-delay="100">
                        <h3 class="room_main-sidebar_contact-title">Need Help?</h3>
                        <p class="room_main-sidebar_contact-text">Contact us for any questions about this room</p>
                        <a class="room_main-sidebar_contact_link" href="{{ route('contacts.index') }}">
                            <i class="icon-call icon"></i>
                            <span>Contact Us</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($relatedRooms->count() > 0)
    <section class="room_recommendation section">
        <div class="container">
            <div class="room_recommendation_header text-center">
                <h2 class="room_recommendation_header-title" data-aos="fade-up">Similar Rooms</h2>
                <p class="room_recommendation_header-text" data-aos="fade-up" data-aos-delay="50">
                    You might also like these rooms
                </p>
            </div>
            <div class="room_recommendation_main">
                <div class="room_recommendation_main-grid">
                    @foreach($relatedRooms as $relatedRoom)
                    <div class="room_recommendation_main-grid_item" data-aos="fade-up">
                        <div class="room_recommendation_main-grid_item-media">
                            <img class="room_recommendation_main-grid_item-media_img" src="{{ asset($relatedRoom->image) }}" alt="{{ $relatedRoom->name }}" />
                            <div class="room_recommendation_main-grid_item-media_overlay">
                                <a class="room_recommendation_main-grid_item-media_overlay-link" href="{{ route('rooms.show', $relatedRoom->id) }}">
                                    <i class="icon-arrow_right icon"></i>
                                </a>
                            </div>
                        </div>
                        <div class="room_recommendation_main-grid_item-content">
                            <h3 class="room_recommendation_main-grid_item-content_title">
                                <a href="{{ route('rooms.show', $relatedRoom->id) }}">{{ $relatedRoom->name }}</a>
                            </h3>
                            <p class="room_recommendation_main-grid_item-content_text">{{ Str::limit($relatedRoom->description, 80) }}</p>
                            <div class="room_recommendation_main-grid_item-content_footer d-flex align-items-center justify-content-between">
                                <div class="room_recommendation_main-grid_item-content_footer_price">
                                    <span class="currency">$</span>
                                    <span class="amount">{{ $relatedRoom->price }}</span>
                                    <span class="period">/night</span>
                                </div>
                                <a class="room_recommendation_main-grid_item-content_footer_link" href="{{ route('rooms.show', $relatedRoom->id) }}">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('asset/js/room.min.js') }}"></script>
@endpush 