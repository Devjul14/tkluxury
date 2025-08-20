@extends('layouts.app')

@section('title', 'Payment')

@php
$page = 'payment';
@endphp

@section('content')
<div class="container">

    <div class="card mt-5">
        <h3 class="card-header p-3">Laravel 11 Razorpay Payment Gateway Integration - ItSolutionStuff.com</h3>
        <div class="card-body">

            @session('error')
                <div class="alert alert-danger" role="alert"> 
                    {{ $value }}
                </div>
            @endsession

            @session('success')
                <div class="alert alert-success" role="alert"> 
                    {{ $value }}
                </div>
            @endsession

            <form action="{{ route('razorpay.payment.store') }}" method="POST" class="text-center">
                @csrf
                <script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZORPAY_KEY') }}"
                        data-amount="1000"
                        data-buttontext="Pay 10 MYR"
                        data-name="tkluxuryhouses.com"
                        data-description="Rozerpay"
                        data-image="https://tkluxuryhouses.com/storage/settings/01K2C25396FS73V5SQWVKNY5SN.png"
                        data-prefill.name="name"
                        data-prefill.email="email"
                        data-theme.color="#ff7529">
                </script>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/common.min.js') }}"></script>
@endpush