@extends('layouts.game')

@section('title','Spinner Game')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/spinner.css') }}">
@endpush

@section('content')
<div class="game-screen">

    <header class="game-header">
        <div class="player-box">
            <i class="fas fa-user-circle"></i>
            <div>
                <div class="player-name">{{ auth()->user()->name ?? 'Player' }}</div>
                <div>Retailer</div>
            </div>
        </div>

        <div class="game-logo">INDIAN CLASSIC</div>

        <div class="game-info">
            <div class="timer-box" id="roundTimer">02:00</div>
            <div class="wallet-box">₹0.00</div>
        </div>
    </header>

    <main class="game-body">
        <section class="left-panel">
            @include('retailer.spinner.partials.wheel')
        </section>

        <section class="right-panel">
            @include('retailer.spinner.partials.bet-panel')
        </section>
    </main>

    <footer class="game-footer">
        <button class="btn-theme">Home</button>
        <button class="btn-theme">History</button>
        <button class="btn-theme">Result</button>
        <button class="btn-theme">Report</button>
        <button class="btn-theme">Logout</button>
    </footer>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/spinner.js') }}"></script>
@endpush