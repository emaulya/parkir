@extends('layout.layout')

@section('title', 'Area Parkir')

@section('content')
    @include('admin._table', ['judul' => 'Data Area Parkir', 'rows' => $rows])
@endsection