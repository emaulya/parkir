@extends('layout.layout')

@section('title', 'Kendaraan')

@section('content')
    @include('admin._table', ['judul' => 'Data Kendaraan', 'rows' => $rows])
@endsection