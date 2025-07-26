@extends('layouts.app')

@section('title', 'Rooms')

@php
    $page = 'rooms';
@endphp

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
                <div class="rooms_main-filter">
                    <form class="rooms_main-filter_form" action="{{ route('rooms.index') }}" method="GET">
                        <div class="rooms_main-filter_form-wrapper d-flex flex-wrap align-items-center">
                            <div class="rooms_main-filter_form-group">
                                <label class="rooms_main-filter_form-group_label" for="checkIn">Check-in</label>
                                <div class="rooms_main-filter_form-group_wrapper">
                                    <i class="icon-calendar icon"></i>
                                    <input
                                        class="rooms_main-filter_form-group_field field"
                                        type="text"
                                        id="checkIn"
                                        name="check_in"
                                        value="{{ request('check_in', 'Add date') }}"
                                        readonly
                                    />
                                    <i class="icon-chevron_down icon"></i>
                                </div>
                            </div>
                            <div class="rooms_main-filter_form-group">
                                <label class="rooms_main-filter_form-group_label" for="checkOut">Check-out</label>
                                <div class="rooms_main-filter_form-group_wrapper">
                                    <i class="icon-calendar icon"></i>
                                    <input
                                        class="rooms_main-filter_form-group_field field"
                                        type="text"
                                        id="checkOut"
                                        name="check_out"
                                        value="{{ request('check_out', 'Add date') }}"
                                        readonly
                                    />
                                    <i class="icon-chevron_down icon"></i>
                                </div>
                            </div>
                            <div class="rooms_main-filter_form-group">
                                <label class="rooms_main-filter_form-group_label" for="guests">Guests</label>
                                <div class="rooms_main-filter_form-group_wrapper">
                                    <i class="icon-user icon"></i>
                                    <input
                                        class="rooms_main-filter_form-group_field field"
                                        type="text"
                                        id="guests"
                                        name="guests"
                                        value="{{ request('guests', '1 Guest') }}"
                                        readonly
                                    />
                                    <i class="icon-chevron_down icon"></i>
                                </div>
                            </div>
                            <div class="rooms_main-filter_form-group">
                                <label class="rooms_main-filter_form-group_label" for="price">Price Range</label>
                                <div class="rooms_main-filter_form-group_wrapper">
                                    <i class="icon-dollar icon"></i>
                                    <select class="rooms_main-filter_form-group_field field" id="price" name="price_range">
                                        <option value="">All Prices</option>
                                        <option value="0-50" {{ request('price_range') == '0-50' ? 'selected' : '' }}>$0 - $50</option>
                                        <option value="50-100" {{ request('price_range') == '50-100' ? 'selected' : '' }}>$50 - $100</option>
                                        <option value="100-150" {{ request('price_range') == '100-150' ? 'selected' : '' }}>$100 - $150</option>
                                        <option value="150+" {{ request('price_range') == '150+' ? 'selected' : '' }}>$150+</option>
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
                            <button class="rooms_main-filter_form-submit" type="submit">
                                <span class="rooms_main-filter_form-submit-text">Search</span>
                                <i class="icon-search icon"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="rooms_main-grid">
                    @forelse($rooms as $room)
                    <div class="rooms_main-grid_item" data-aos="fade-up">
                        <div class="rooms_main-grid_item-media">
                            <img class="rooms_main-grid_item-media_img" src="{{ asset($room->image) }}" alt="{{ $room->name }}" />
                            <div class="rooms_main-grid_item-media_overlay">
                                <a class="rooms_main-grid_item-media_overlay-link" href="{{ route('rooms.show', $room->id) }}">
                                    <i class="icon-arrow_right icon"></i>
                                </a>
                            </div>
                            @if($room->is_featured)
                            <div class="rooms_main-grid_item-media_badge">
                                <span class="badge">Featured</span>
                            </div>
                            @endif
                        </div>
                        <div class="rooms_main-grid_item-content">
                            <h3 class="rooms_main-grid_item-content_title">
                                <a href="{{ route('rooms.show', $room->id) }}">{{ $room->name }}</a>
                            </h3>
                            <p class="rooms_main-grid_item-content_text">{{ Str::limit($room->description, 100) }}</p>
                            <div class="rooms_main-grid_item-content_features">
                                <ul class="rooms_main-grid_item-content_features-list">
                                    @foreach($room->amenities->take(3) as $amenity)
                                    <li class="list-item">
                                        <i class="icon-{{ $amenity->icon }} icon"></i>
                                        <span>{{ $amenity->name }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="rooms_main-grid_item-content_footer d-flex align-items-center justify-content-between">
                                <div class="rooms_main-grid_item-content_footer_price">
                                    <span class="rooms_main-grid_item-content_footer_price-currency">$</span>
                                    <span class="rooms_main-grid_item-content_footer_price-amount">{{ $room->price }}</span>
                                    <span class="rooms_main-grid_item-content_footer_price-period">/night</span>
                                </div>
                                <a class="rooms_main-grid_item-content_footer_link" href="{{ route('rooms.show', $room->id) }}">
                                    Book Now
                                </a>
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

            @if ($rooms->hasPages())
            <div class="rooms_main-pagination">
                {{ $rooms->appends(request()->query())->links() }}
            </div>
            @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('asset/js/rooms.min.js') }}"></script>
@endpush 