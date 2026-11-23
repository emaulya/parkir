@extends('layout.layout')

@section('title', 'Transaksi Parkir')

@section('content')
    @include('admin._table', ['judul' => 'Data Transaksi Parkir', 'rows' => $rows])
@endsection