@extends('layouts.admin')

@section('title', 'Edit Game Type')

@section('content')

<div class="content-header">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center">

            <h1>Edit Game Type</h1>

            <a href="{{ route('admin.game-types.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

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

<form method="POST"
      action="{{ route('admin.game-types.update',$gameType) }}">

    @csrf
    @method('PUT')

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                Game Type Information

            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name',$gameType->name) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Code</label>

                    <input
                        type="text"
                        name="code"
                        class="form-control text-uppercase"
                        value="{{ old('code',$gameType->code) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Sort Order</label>

                    <input
                        type="number"
                        name="sort_order"
                        class="form-control"
                        value="{{ old('sort_order',$gameType->sort_order) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Status</label>

                    <select
                        name="is_active"
                        class="form-select">

                        <option value="1"
                            @selected(old('is_active',$gameType->is_active)==1)>
                            Active
                        </option>

                        <option value="0"
                            @selected(old('is_active',$gameType->is_active)==0)>
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="col-md-12">

                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control">{{ old('description',$gameType->description) }}</textarea>

                </div>

            </div>

        </div>

    </div>

    <div class="text-end">

        <button
            type="submit"
            class="btn btn-success">

            <i class="fas fa-save"></i>

            Update Game Type

        </button>

    </div>

</form>

@endsection