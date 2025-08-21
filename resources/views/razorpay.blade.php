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


        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/common.min.js') }}"></script>
@endpush