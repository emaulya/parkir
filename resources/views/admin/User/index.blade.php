@extends('layout.layout')

@section('title', 'Data User')

@section('content')
    @include('admin._table', ['judul' => 'Data User', 'rows' => $rows])
@endsection