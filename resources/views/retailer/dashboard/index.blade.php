@extends('layouts.retailer')

@section('title', 'Retailer Dashboard')

@section('content')

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Retailer Dashboard
                </h1>

            </div>

        </div>

    </div>

</div>

<section class="content">

    <div class="container-fluid">

        {{-- Welcome --}}
        <div class="alert alert-primary">

            <h5 class="mb-1">

                Welcome,

                <strong>{{ auth()->user()->username }}</strong>

            </h5>

            <small>

                Have a great day!

            </small>

        </div>

        {{-- Statistics --}}
        <div class="row">

            <div class="col-lg-3 col-md-6">

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3>

                            ₹ {{ number_format($todayBet,2) }}

                        </h3>

                        <p>

                            Today's Bets

                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-money-bill-wave"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="small-box bg-success">

                    <div class="inner">

                        <h3>

                            ₹ 0.00

                        </h3>

                        <p>

                            Today's Winning

                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-trophy"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3>

                            ₹ {{ number_format($retailer?->daily_limit ?? 0,2) }}

                        </h3>

                        <p>

                            Daily Limit

                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-wallet"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="small-box bg-danger">

                    <div class="inner">

                        <h3>

                            {{ $game?->name ?? '-' }}

                        </h3>

                        <p>

                            Current Game

                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-dice"></i>

                    </div>

                </div>

            </div>

        </div>

        {{-- Current Round --}}
        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Current Round

                </h3>

            </div>

            <div class="card-body">

                @if($round)

                    <div class="row">

                        <div class="col-md-3">

                            <strong>Round No</strong>

                            <br>

                            {{ $round->round_no }}

                        </div>

                        <div class="col-md-3">

                            <strong>Status</strong>

                            <br>

                            <span class="badge bg-success">

                                {{ $round->status }}

                            </span>

                        </div>

                        <div class="col-md-3">

                            <strong>Ends At</strong>

                            <br>

                            {{ $round->end_time->format('h:i A') }}

                        </div>

                        <div class="col-md-3">

                            <strong>Time Left</strong>

                            <br>

                            <span id="countdown"
                                  class="badge bg-danger p-2">

                                Loading...

                            </span>

                        </div>

                    </div>

                    <hr>

                    <a href="{{ route('retailer.spinner.index') }}"
                       class="btn btn-success btn-lg">

                        <i class="fas fa-play-circle"></i>

                        Play Spinner

                    </a>

                @else

                    <div class="alert alert-warning mb-0">

                        No Open Round Available.

                    </div>

                @endif

            </div>

        </div>

        {{-- Quick Menu --}}
        <div class="row">

            <div class="col-md-4">

                <a href="{{ route('retailer.spinner.index') }}"
                   class="btn btn-primary btn-block btn-lg">

                    <i class="fas fa-dice"></i>

                    Spinner Game

                </a>

            </div>

            <div class="col-md-4">

                <button class="btn btn-info btn-block btn-lg">

                    <i class="fas fa-history"></i>

                    My Bets

                </button>

            </div>

            <div class="col-md-4">

                <button class="btn btn-success btn-block btn-lg">

                    <i class="fas fa-trophy"></i>

                    Results

                </button>

            </div>

        </div>

    </div>

</section>

@endsection

@push('scripts')

@if($round)

<script>

let endTime = new Date("{{ $round->end_time->format('Y-m-d H:i:s') }}").getTime();

let timer = setInterval(function () {

    let now = new Date().getTime();

    let distance = endTime - now;

    if (distance <= 0) {

        clearInterval(timer);

        $('#countdown').html('Round Closed');

        return;

    }

    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    $('#countdown').html(

        minutes.toString().padStart(2,'0') +

        ":" +

        seconds.toString().padStart(2,'0')

    );

},1000);

</script>

@endif

@endpush