@extends('layouts.app')

@section('title', 'Gallery')

@php
$page = 'faq';
@endphp

@section('content')
<header class="page">
    <div class="container">
        <!-- <ul class="breadcrumbs d-flex flex-wrap align-content-center">
            <li class="list-item">
                <a class="link" href="index.html">Home</a>
            </li>

            <li class="list-item">
                <a class="link" href="#">About Hosteller</a>
            </li>
        </ul> -->
        <h1 class="page_title">Popular questions about the hostel</h1>
        <!-- <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
            Popular questions about the hostel
        </p> -->
    </div>
</header>

<main>
    <!-- FAQ section start -->
    <div class="accordion section--nopb">
        <div class="container">
            <div class="accordion_component d-md-flex flex-wrap">
                <!-- item 1 -->
                <div class="accordion_component-item col-md-6 col-xl-4" data-order="1">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4
                            class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#item-1"
                            aria-expanded="true">
                            How do you choose the right hostel?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-1" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie at
                                element eu facilisis sed excepteur sint occaecat
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 2 -->
                <div class="accordion_component-item col-md-6 col-xl-4" data-order="2">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4
                            class="accordion_component-item_header d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse"
                            data-bs-target="#item-2"
                            aria-expanded="true">
                            How many people are in a hostel room?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-2" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie at
                                element eu facilisis sed excepteur sint occaecat
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 3 -->
                <div class="accordion_component-item col-md-6 col-xl-4" data-order="3">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4
                            class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#item-3"
                            aria-expanded="true">
                            Are there private rooms in Hostels?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-3" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie at
                                element eu facilisis sed excepteur sint occaecat
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 4 -->
                <div class="accordion_component-item col-md-6 col-xl-4" data-order="4">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4
                            class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#item-4"
                            aria-expanded="true">
                            How do I keep my things safe in a hostel?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-4" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie at
                                element eu facilisis sed excepteur sint occaecat
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 5 -->
                <div class="accordion_component-item col-md-6 col-xl-4" data-order="5">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4
                            class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#item-5"
                            aria-expanded="true">
                            How do you stay safe in a hostel?
                            <span class="wrapper">
                                <i class="icon-chevron_down icon transform"></i>
                            </span>
                        </h4>
                        <div id="item-5" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie at
                                element eu facilisis sed excepteur sint occaecat
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item 6 -->
                <div class="accordion_component-item col-md-6 col-xl-4" data-order="6">
                    <div class="item-wrapper d-flex flex-column justify-content-between">
                        <h4
                            class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#item-6"
                            aria-expanded="true">
                            Can I arrive at a hostel before check-in?
                            <i class="icon-chevron_down icon transform"></i>
                        </h4>
                        <div id="item-6" class="accordion-collapse collapse show">
                            <div class="accordion_component-item_body">
                                Consequat interdum varius sit amet mattis vulputate enim nulla. Posuere morbi leo urna molestie at
                                element eu facilisis sed excepteur sint occaecat
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ section end -->
    <!-- contacts section start -->
    <section class="faq-contacts section">
        <div class="container container--contacts d-xl-flex align-items-center justify-content-between">
            <div class="contacts" data-aos="fade-up">
                <div class="contacts_header">
                    <h2 class="contacts_header-title">Get in touch</h2>
                    <p class="contacts_header-text">
                        Egestas pretium aenean pharetra magna ac. Et tortor consequat id porta nibh venenatis cras sed
                    </p>
                </div>
                <form
                    class="contacts_form form d-sm-flex flex-wrap justify-content-between"
                    action="form.php"
                    method="post"
                    data-type="feedback">
                    <div class="field-wrapper">
                        <label class="label" for="feedbackName">
                            <i class="icon-user icon"></i>
                        </label>
                        <input class="field required" id="feedbackName" type="text" placeholder="Name" />
                    </div>
                    <div class="field-wrapper">
                        <label class="label" for="feedbackEmail">
                            <i class="icon-email icon"></i>
                        </label>
                        <input class="field required" id="feedbackEmail" type="text" data-type="email" placeholder="Email" />
                    </div>
                    <textarea class="field textarea required" id="feedbackMessage" placeholder="Message"></textarea>
                    <button class="btn theme-element theme-element--accent" type="submit">Submit</button>
                </form>
            </div>
            <div class="map">
                <div id="map"></div>
            </div>
        </div>
    </section>
    <!-- contacts section end -->
</main>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/common.min.js') }}"></script>
@endpush