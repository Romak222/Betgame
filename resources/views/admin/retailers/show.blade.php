@extends('layouts.admin')

@section('title', 'Retailer Details')

@section('content')

<div class="content-header">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h1>Retailer Details</h1>

            <div>

                <a href="{{ route('admin.retailers.edit', $retailer) }}"
                   class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

                <a href="{{ route('admin.retailers.index') }}"
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

            Retailer Information

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="250">Login ID</th>

                <td>{{ $retailer->user->login_id }}</td>

            </tr>

            <tr>

                <th>Username</th>

                <td>{{ $retailer->user->username }}</td>

            </tr>

            <tr>

                <th>Email</th>

                <td>{{ $retailer->user->email ?? '-' }}</td>

            </tr>

            <tr>

                <th>Shop Name</th>

                <td>{{ $retailer->shop_name }}</td>

            </tr>

            <tr>

                <th>Shop Code</th>

                <td>{{ $retailer->shop_code }}</td>

            </tr>

            <tr>

                <th>Owner Name</th>

                <td>{{ $retailer->owner_name }}</td>

            </tr>

            <tr>

                <th>Mobile</th>

                <td>{{ $retailer->mobile }}</td>

            </tr>

            <tr>

                <th>Alternate Mobile</th>

                <td>{{ $retailer->alternate_mobile ?: '-' }}</td>

            </tr>

            <tr>

                <th>Address</th>

                <td>{{ $retailer->address }}</td>

            </tr>

            <tr>

                <th>City</th>

                <td>{{ $retailer->city }}</td>

            </tr>

            <tr>

                <th>State</th>

                <td>{{ $retailer->state }}</td>

            </tr>

            <tr>

                <th>Pincode</th>

                <td>{{ $retailer->pincode }}</td>

            </tr>

            <tr>

                <th>Margin</th>

                <td>{{ $retailer->margin }} %</td>

            </tr>

            <tr>

                <th>Daily Limit</th>

                <td>₹ {{ number_format($retailer->daily_limit, 2) }}</td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    @if($retailer->status)

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

            <tr>

                <th>Created</th>

                <td>{{ $retailer->created_at->format('d M Y h:i A') }}</td>

            </tr>

            <tr>

                <th>Last Login</th>

                <td>

                    {{ $retailer->last_login?->format('d M Y h:i A') ?? 'Never' }}

                </td>

            </tr>

            <tr>

                <th>Notes</th>

                <td>{{ $retailer->notes ?: '-' }}</td>

            </tr>

        </table>

    </div>

</div>

@endsection