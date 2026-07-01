{{-- Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <strong>
            <i class="fas fa-exclamation-circle me-1"></i>
            Please fix the following errors:
        </strong>

        <ul class="mb-0 mt-2 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>
@endif


{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <i class="fas fa-check-circle me-1"></i>

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>
@endif


{{-- Error Message --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <i class="fas fa-times-circle me-1"></i>

        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>
@endif


{{-- Warning Message --}}
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">

        <i class="fas fa-exclamation-triangle me-1"></i>

        {{ session('warning') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>
@endif


{{-- Info Message --}}
@if (session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">

        <i class="fas fa-info-circle me-1"></i>

        {{ session('info') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>
@endif