@extends('dashboard.layout')

@section('page-title', 'Company Management')
@section('page-subtitle', 'Manage your companies efficiently')

@section('content')
<div class="main-content-col">
    <!-- Enhanced Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4"></div>
    @include('companies.component')
</div>

@endsection