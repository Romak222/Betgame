@extends('layouts.admin')

@section('title','Create Game')

@section('content')

<div class="content-header">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center">

            <h1>Create Game</h1>

            <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

</div>

@if($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form method="POST" action="{{ route('admin.games.store') }}">

    @csrf

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Game Information

            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Game Type</label>

                    <select name="game_type_id" class="form-select" required>

                        <option value="">Select Game Type</option>

                        @foreach($gameTypes as $type)

                        <option value="{{ $type->id }}">

                            {{ $type->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Game Name</label>

                    <input type="text" name="name" class="form-control" required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Game Code</label>

                    <input type="text" name="code" class="form-control" required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Open Time</label>

                    <input type="time" name="open_time" class="form-control" required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Close Time</label>

                    <input type="time" name="close_time" class="form-control" required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Result Time</label>

                    <input type="time" name="result_time" class="form-control" required>

                </div>
                <div class="col-md-4 mb-3">

                    <label>Round Duration </label>

                    <select name="round_duration_seconds" class="form-select" required>
                        <option value="30">30 Seconds</option>
                        <option value="60">1 Minute</option>
                        <option value="90" selected>1 Minute 30 Seconds</option>
                        <option value="120">2 Minutes</option>
                        <option value="180">3 Minutes</option>
                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Minimum Bid</label>

                    <input type="number" step="0.01" name="min_bid" class="form-control" value="0">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Maximum Bid</label>

                    <input type="number" step="0.01" name="max_bid" class="form-control" value="0">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Sort Order</label>

                    <input type="number" name="sort_order" class="form-control" value="0">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Status</label>

                    <select name="is_active" class="form-select">

                        <option value="1">

                            Active

                        </option>

                        <option value="0">

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>

    <div class="text-end">

        <button class="btn btn-success">

            <i class="fas fa-save"></i>

            Save Game

        </button>

    </div>

</form>

@endsection