@extends('layouts.admin')

@section('title', 'Game Type Details')

@section('content')

<div class="content-header">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h1>Game Type Details</h1>

            <div>

                <a href="{{ route('admin.game-types.edit', $gameType) }}"
                   class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>

                <a href="{{ route('admin.game-types.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </div>

        </div>

    </div>
</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Game Type Information
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="250">Name</th>
                <td>{{ $gameType->name }}</td>
            </tr>

            <tr>
                <th>Code</th>
                <td>{{ $gameType->code }}</td>
            </tr>

            <tr>
                <th>Description</th>
                <td>{{ $gameType->description ?: '-' }}</td>
            </tr>

            <tr>
                <th>Sort Order</th>
                <td>{{ $gameType->sort_order }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if($gameType->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Created On</th>
                <td>{{ $gameType->created_at->format('d M Y h:i A') }}</td>
            </tr>

            <tr>
                <th>Last Updated</th>
                <td>{{ $gameType->updated_at->format('d M Y h:i A') }}</td>
            </tr>

        </table>

    </div>

</div>

@endsection