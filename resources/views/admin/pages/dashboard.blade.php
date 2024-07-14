@extends('admin.layouts.master')
@section('page_title', 'Dashboard')

@push('admin_style')
@endpush

@section('admin_content')
    <h1>Welcome {{ Auth::user()->name }}</h1>
@endsection

@push('admin_script')
@endpush
