@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Users')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Users')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">Manager User</div>
      <div class="card-body">
        {{ $dataTable->table() }}
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}    
@endpush