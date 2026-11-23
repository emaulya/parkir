@extends('layout.layout')

@section('title', 'Log Aktivitas')

@section('content')
    @include('admin._table', ['judul' => 'Log Aktivitas', 'rows' => $rows])
@endsection