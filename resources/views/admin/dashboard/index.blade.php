@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Welcome,
                    {{ auth()->user()->username }}

                </h3>

            </div>

            <div class="card-body">

                <p class="mb-0">

                    You are logged in as

                    <strong>

                        {{ auth()->user()->getRoleNames()->implode(', ') }}

                    </strong>

                </p>

            </div>

        </div>

    </div>

</div>

<div class="row">

    {{-- Total Users --}}
    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-primary">

            <div class="inner">

                <h3>

                    {{ $dashboardData['total_users'] }}

                </h3>

                <p>Total Users</p>

            </div>

            <div class="icon">

                <i class="fas fa-users"></i>

            </div>

        </div>

    </div>

    {{-- Total Retailers --}}
    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>

                    {{ $dashboardData['total_retailers'] }}

                </h3>

                <p>Total Retailers</p>

            </div>

            <div class="icon">

                <i class="fas fa-store"></i>

            </div>

        </div>

    </div>

    {{-- Total Games --}}
    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>

                    {{ $dashboardData['total_games'] }}

                </h3>

                <p>Total Games</p>

            </div>

            <div class="icon">

                <i class="fas fa-gamepad"></i>

            </div>

        </div>

    </div>

    {{-- Total Rounds --}}
    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>

                    {{ $dashboardData['total_rounds'] }}

                </h3>

                <p>Total Rounds</p>

            </div>

            <div class="icon">

                <i class="fas fa-clock"></i>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-6">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Today's Statistics

                </h3>

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>

                        <th>Today's Users</th>

                        <td>{{ $dashboardData['today_users'] }}</td>

                    </tr>

                    <tr>

                        <th>Today's Retailers</th>

                        <td>{{ $dashboardData['today_retailers'] }}</td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    System Information

                </h3>

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>

                        <th>Application</th>

                        <td>Indian Classic</td>

                    </tr>

                    <tr>

                        <th>Laravel</th>

                        <td>{{ app()->version() }}</td>

                    </tr>

                    <tr>

                        <th>PHP</th>

                        <td>{{ PHP_VERSION }}</td>

                    </tr>

                    <tr>

                        <th>Server Time</th>

                        <td>{{ now()->format('d-m-Y h:i A') }}</td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection