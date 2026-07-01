<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Account Information
        </h3>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Username <span class="text-danger">*</span>
                </label>

                <input type="text"
                       name="username"
                       class="form-control @error('username') is-invalid @enderror"
                       value="{{ old('username', $retailer->user->username ?? '') }}"
                       required>

                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $retailer->user->email ?? '') }}">

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Password

                    @isset($retailer)
                        <small class="text-muted">(Leave blank to keep existing password)</small>
                    @endisset

                </label>

                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror">

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Confirm Password

                </label>

                <input type="password"
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

                <input type="text"
                       name="shop_name"
                       class="form-control"
                       value="{{ old('shop_name', $retailer->shop_name ?? '') }}"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label>Owner Name</label>

                <input type="text"
                       name="owner_name"
                       class="form-control"
                       value="{{ old('owner_name', $retailer->owner_name ?? '') }}"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label>Mobile</label>

                <input type="text"
                       name="mobile"
                       class="form-control"
                       value="{{ old('mobile', $retailer->mobile ?? '') }}"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label>Alternate Mobile</label>

                <input type="text"
                       name="alternate_mobile"
                       class="form-control"
                       value="{{ old('alternate_mobile', $retailer->alternate_mobile ?? '') }}">

            </div>

            <div class="col-md-12 mb-3">

                <label>Address</label>

                <textarea
                    name="address"
                    rows="3"
                    class="form-control"
                    required>{{ old('address', $retailer->address ?? '') }}</textarea>

            </div>

            <div class="col-md-4 mb-3">

                <label>City</label>

                <input type="text"
                       name="city"
                       class="form-control"
                       value="{{ old('city', $retailer->city ?? '') }}">

            </div>

            <div class="col-md-4 mb-3">

                <label>State</label>

                <input type="text"
                       name="state"
                       class="form-control"
                       value="{{ old('state', $retailer->state ?? '') }}">

            </div>

            <div class="col-md-4 mb-3">

                <label>Pincode</label>

                <input type="text"
                       name="pincode"
                       class="form-control"
                       value="{{ old('pincode', $retailer->pincode ?? '') }}">

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

                <input type="number"
                       step="0.01"
                       name="margin"
                       class="form-control"
                       value="{{ old('margin', $retailer->margin ?? 0) }}">

            </div>

            <div class="col-md-4 mb-3">

                <label>Daily Limit</label>

                <input type="number"
                       name="daily_limit"
                       class="form-control"
                       value="{{ old('daily_limit', $retailer->daily_limit ?? 0) }}">

            </div>

            <div class="col-md-4 mb-3">

                <label>Status</label>

                <select
                    name="status"
                    class="form-select">

                    <option value="1"
                        @selected(old('status', $retailer->status ?? 1) == 1)>
                        Active
                    </option>

                    <option value="0"
                        @selected(old('status', $retailer->status ?? 1) == 0)>
                        Inactive
                    </option>

                </select>

            </div>

            <div class="col-md-12">

                <label>Notes</label>

                <textarea
                    name="notes"
                    rows="3"
                    class="form-control">{{ old('notes', $retailer->notes ?? '') }}</textarea>

            </div>

        </div>

    </div>

</div>

<div class="text-end">

    <button class="btn btn-success">

        <i class="fas fa-save"></i>

        Save Retailer

    </button>

</div>