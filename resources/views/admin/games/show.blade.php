@extends('layouts.admin')

@section('title','Game Details')

@section('content')

<div class="content-header">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center">

            <h1>Game Details</h1>

            <div>

                <a href="{{ route('admin.games.edit',$game) }}" class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

                <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">

                    Back

                </a>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Game Information

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="250">Game Type</th>
                <td>{{ $game->gameType->name }}</td>
            </tr>

            <tr>
                <th>Game Name</th>
                <td>{{ $game->name }}</td>
            </tr>

            <tr>
                <th>Game Code</th>
                <td>{{ $game->code }}</td>
            </tr>

            <tr>
                <th>Open Time</th>
                <td>{{ $game->open_time }}</td>
            </tr>

            <tr>
                <th>Close Time</th>
                <td>{{ $game->close_time }}</td>
            </tr>

            <tr>
                <th>Result Time</th>
                <td>{{ $game->result_time }}</td>
            </tr>
            <tr>

                <th>Round Duration</th>

                <td>{{ $game->round_duration }} Minutes</td>

            </tr>

            <tr>
                <th>Minimum Bid</th>
                <td>₹ {{ number_format($game->min_bid,2) }}</td>
            </tr>

            <tr>
                <th>Maximum Bid</th>
                <td>₹ {{ number_format($game->max_bid,2) }}</td>
            </tr>

            <tr>
                <th>Sort Order</th>
                <td>{{ $game->sort_order }}</td>
            </tr>

            <tr>
                <th>Status</th>

                <td>

                    @if($game->is_active)

                    <span class="badge bg-success">

                        Active

                    </span>

                    @else

                    <span class="badge bg-danger">

                        Inactive

                    </span>

                    @endif

                </td>

            </tr>

        </table>

    </div>

</div>

@endsection