@extends('layouts.app')

@section('title', 'Privacy Policy')

@php
$page = 'faq';
@endphp

@section('content')
<header class="page">
    <div class="container">
        <div class="page_header">
            <h1 class="page_header-title" data-aos="fade-up">{{ __('Privacy Policy') }}</h1>
            <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                {{ __('Lorem ipsum, dolor sit amet consectetur adipisicing.') }}
            </p>
        </div>
    </div>
</header>

<section class="rules section">
    <div class="container">
        <div class="rules_header text-center mb-4">
            <p class="rules_header-text" data-aos="fade-up" data-aos-delay="50">
                {{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus maxime similique suscipit voluptatem id debitis nobis harum iure animi provident aperiam cumque eaque possimus voluptatum porro ea fugit deserunt, numquam reiciendis magnam in est! Pariatur nesciunt eum molestias, dolore corporis sint ratione recusandae atque voluptas commodi vel blanditiis maxime asperiores veritatis architecto, vitae delectus! Modi, doloremque eos ratione dolores fugit nam inventore facere similique, architecto deleniti assumenda repellendus magni nemo iste nisi fugiat voluptate magnam porro! Aperiam aut recusandae excepturi!') }}
            </p>
        </div>
        <div class="rules_main">
            <div class="rules_main-grid">
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('Lorem ipsum dolor sit.') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis magnam, incidunt iste iusto velit voluptate!') }}</li>
                        <li>{{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, illo.') }}</li>
                        <li>{{ __('Lorem ipsum dolor sit amet consectetur adipisicing.') }}</li>
                        <li>{{ __('Lorem ipsum dolor sit amet.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('Lorem ipsum dolor sit.') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis magnam, incidunt iste iusto velit voluptate!') }}</li>
                        <li>{{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, illo.') }}</li>
                        <li>{{ __('Lorem ipsum dolor sit amet consectetur adipisicing.') }}</li>
                        <li>{{ __('Lorem ipsum dolor sit amet.') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/common.min.js') }}"></script>
@endpush