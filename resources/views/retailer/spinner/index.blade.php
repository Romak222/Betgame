@extends('layouts.game')

@section('title','Spinner Game')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/animations.css') }}">
<link rel="stylesheet" href="{{ asset('css/spinner.css') }}">
@endpush

@section('content')

<div class="game-screen">

    {{-- Header --}}
    <header class="game-header">

        <div class="player-box">

            <i class="fas fa-user-circle"></i>

            <div>

                <div class="player-name">
                    {{ auth()->user()->name }}
                </div>

                <small>Retailer</small>

            </div>

        </div>

        <div class="game-logo">
            INDIAN CLASSIC
        </div>

        <div class="game-info">

            <div class="timer-box">

                <i class="fas fa-clock"></i>

                <span id="countdown">02:00</span>

            </div>

            <div class="wallet-box">

                ₹0.00

            </div>

        </div>

    </header>

    <div class="game-body">

        <div class="left-panel">

            @include('retailer.spinner.partials.wheel')

        </div>

        <div class="right-panel">

            @include('retailer.spinner.partials.bet-panel')

        </div>

    </div>

    <footer class="game-footer">

        FOOTER BUTTONS

    </footer>

</div>

@endsection

@push('scripts')

<script src="{{ asset('js/wheel.js') }}"></script>

<script src="{{ asset('js/spinner.js') }}"></script>

@endpush