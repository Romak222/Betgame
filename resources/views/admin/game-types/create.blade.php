@extends('layouts.admin')

@section('title', 'Create Game Type')

@section('content')

<div class="content-header">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center">

            <h1>Create Game Type</h1>

            <a href="{{ route('admin.game-types.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('admin.game-types.store') }}"
      method="POST">

@csrf

<div class="card">

<div class="card-header">

<h3 class="card-title">

Game Type Information

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">

<label>Name <span class="text-danger">*</span></label>

<input
type="text"
name="name"
class="form-control"
value="{{ old('name') }}"
required>

</div>

<div class="col-md-6 mb-3">

<label>Code <span class="text-danger">*</span></label>

<input
type="text"
name="code"
class="form-control text-uppercase"
value="{{ old('code') }}"
required>

<small class="text-muted">

Example:
SG, JD, SP, DP

</small>

</div>

<div class="col-md-6 mb-3">

<label>Sort Order</label>

<input
type="number"
name="sort_order"
class="form-control"
value="{{ old('sort_order',0) }}">

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select
name="is_active"
class="form-select">

<option value="1">

Active

</option>

<option value="0">

Inactive

</option>

</select>

</div>

<div class="col-md-12">

<label>Description</label>

<textarea
name="description"
rows="4"
class="form-control">{{ old('description') }}</textarea>

</div>

</div>

</div>

</div>

<div class="text-end">

<button
type="submit"
class="btn btn-success">

<i class="fas fa-save"></i>

Save Game Type

</button>

</div>

</form>

@endsection