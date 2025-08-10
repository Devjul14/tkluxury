@extends('layouts.app')

@section('title', 'Home')

@php
$page = 'index';
@endphp

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    #map {
        height: 500px;
        width: 100%;
        margin-bottom: 2rem;
    }

    /* style lama kamu */
    .container--hero {
        position: relative;
        z-index: 999999999;
        background-color: transparent;
    }

    /* ...lanjut style kamu yang lain... */
</style>
@endpush

@section('content')
<section class="hero section">
    <div class="container mb-8 container--hero d-lg-flex align-items-center justify-content-between">
        {{-- Form filter tetap --}}
        @include('partials.search-form')
    </div>

    {{-- Map Section --}}
    <div class="container">
        <div id="map"></div>
    </div>

    {{-- Results Section --}}
    <div class="container mt-4">
        <ul class="rooms_list d-md-flex flex-wrap">
            @foreach($properties as $index => $property)
            {{-- hasil list property seperti di kode kamu --}}
            @endforeach
        </ul>
        <x-pagination :paginator="$pagedProperties" />
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('asset/js/gallery.min.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter auto submit
        const fields = document.querySelectorAll('form input, form select');
        fields.forEach((field) => {
            field.addEventListener('change', function(e) {
                if (e.target.name !== 'student') {
                    e.target.closest('form').submit();
                }
            });
        });

        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d"
        });

        document.querySelector('#filterSubmit').addEventListener('click', function(e) {
            e.target.closest('form').submit();
        });

        // Leaflet Map
        const map = L.map('map').setView(
            [{
                {
                    $institute - > latitude ?? 0
                }
            }, {
                {
                    $institute - > longitude ?? 0
                }
            }],
            14
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Marker Institute (jika ada data institute)
        @if(!empty($institute))
        L.marker([{
                {
                    $institute - > latitude
                }
            }, {
                {
                    $institute - > longitude
                }
            }])
            .addTo(map)
            .bindPopup('<b>{{ $institute->name }}</b>');
        @endif

        // Markers Properties
        const properties = @json($properties);
        properties.forEach(p => {
            if (p.latitude && p.longitude) {
                L.marker([p.latitude, p.longitude])
                    .addTo(map)
                    .bindPopup(`<b>${p.title}</b><br>${(p.distance/1000).toFixed(2)} km away`);
            }
        });
    });
</script>
@endpush