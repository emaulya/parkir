@extends('layout.layout')

@section('title', 'Tarif Parkir')

@section('content')
    @include('admin._table', ['judul' => 'Data Tarif Parkir', 'rows' => $rows])
@endsection