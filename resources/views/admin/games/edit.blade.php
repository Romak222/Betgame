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

<form method="POST" action="{{ route('admin.games.update',$game) }}">

    @csrf
    @method('PUT')

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

                        @foreach($gameTypes as $type)

                        <option value="{{ $type->id }}" @selected(old('game_type_id',$game->game_type_id)==$type->id)>

                            {{ $type->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Game Name</label>

                    <input type="text" name="name" class="form-control" value="{{ old('name',$game->name) }}" required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Game Code</label>

                    <input type="text" name="code" class="form-control" value="{{ old('code',$game->code) }}" required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Open Time</label>

                    <input type="time" name="open_time" class="form-control"
                        value="{{ old('open_time', \Carbon\Carbon::parse($game->open_time)->format('H:i')) }}" required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Close Time</label>

                    <input type="time" name="close_time" class="form-control"
                        value="{{ old('close_time', \Carbon\Carbon::parse($game->close_time)->format('H:i')) }}"
                        required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Result Time</label>

                    <input type="time" name="result_time" class="form-control"
                        value="{{ old('result_time', \Carbon\Carbon::parse($game->result_time)->format('H:i')) }}"
                        required>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Round Duration (Minutes)</label>

                    <input type="number" name="round_duration" class="form-control"
                        value="{{ old('round_duration',$game->round_duration) }}" min="1" required>

                </div>
                <div class="col-md-4 mb-3">

                    <label>Minimum Bid</label>

                    <input type="number" step="0.01" name="min_bid" class="form-control"
                        value="{{ old('min_bid',$game->min_bid) }}" value="0">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Maximum Bid</label>

                    <input type="number" step="0.01" name="max_bid" class="form-control"
                        value="{{ old('max_bid',$game->max_bid) }}" value="0">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Sort Order</label>

                    <input type="number" name="sort_order" class="form-control"
                        value="{{ old('sort_order',$game->sort_order) }}" value="0">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Status</label>

                    <select name="is_active" class="form-select">

                        <option value="1" @selected(old('is_active',$game->is_active)==1)>
                            Active
                        </option>

                        <option value="0" @selected(old('is_active',$game->is_active)==0)>
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