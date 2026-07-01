@extends('layouts.admin')

@section('title', 'Edit Retailer')

@section('content')

<div class="content-header">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h1>Edit Retailer</h1>

            <a href="{{ route('admin.retailers.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

    </div>

</div>

@include('partials.messages')

<form action="{{ route('admin.retailers.update', $retailer) }}"
      method="POST">

    @csrf

    @method('PUT')

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Account Information

            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username', $retailer->user->username) }}">

                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $retailer->user->email) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>

                        Password

                        <small class="text-muted">

                            (Leave blank to keep existing password)

                        </small>

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control">

                </div>

            </div>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Shop Information

            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Shop Name</label>

                    <input
                        type="text"
                        name="shop_name"
                        class="form-control"
                        value="{{ old('shop_name', $retailer->shop_name) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Owner Name</label>

                    <input
                        type="text"
                        name="owner_name"
                        class="form-control"
                        value="{{ old('owner_name', $retailer->owner_name) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Mobile</label>

                    <input
                        type="text"
                        name="mobile"
                        class="form-control"
                        value="{{ old('mobile', $retailer->mobile) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Alternate Mobile</label>

                    <input
                        type="text"
                        name="alternate_mobile"
                        class="form-control"
                        value="{{ old('alternate_mobile', $retailer->alternate_mobile) }}">

                </div>

                <div class="col-md-12 mb-3">

                    <label>Address</label>

                    <textarea
                        name="address"
                        rows="3"
                        class="form-control">{{ old('address', $retailer->address) }}</textarea>

                </div>

                <div class="col-md-4 mb-3">

                    <label>City</label>

                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        value="{{ old('city', $retailer->city) }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label>State</label>

                    <input
                        type="text"
                        name="state"
                        class="form-control"
                        value="{{ old('state', $retailer->state) }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Pincode</label>

                    <input
                        type="text"
                        name="pincode"
                        class="form-control"
                        value="{{ old('pincode', $retailer->pincode) }}">

                </div>

            </div>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Business Information

            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>Margin (%)</label>

                    <input
                        type="number"
                        step="0.01"
                        name="margin"
                        class="form-control"
                        value="{{ old('margin', $retailer->margin) }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Daily Limit</label>

                    <input
                        type="number"
                        name="daily_limit"
                        class="form-control"
                        value="{{ old('daily_limit', $retailer->daily_limit) }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Status</label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="1"
                            @selected($retailer->status)>
                            Active
                        </option>

                        <option value="0"
                            @selected(!$retailer->status)>
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="col-md-12">

                    <label>Notes</label>

                    <textarea
                        name="notes"
                        rows="3"
                        class="form-control">{{ old('notes', $retailer->notes) }}</textarea>

                </div>

            </div>

        </div>

    </div>

    <div class="text-end mb-4">

        <button
            type="submit"
            class="btn btn-success">

            <i class="fas fa-save"></i>

            Update Retailer

        </button>

    </div>

</form>

@endsection