@extends('layouts.admin')

@section('title','Create Retailer')

@section('content')

<form action="{{ route('admin.retailers.store') }}" method="POST">

    @csrf

    @include('admin.retailers.partials.form')

</form>

@endsection