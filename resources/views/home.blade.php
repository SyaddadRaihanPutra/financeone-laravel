@extends('layouts.custom-layout')
@section('title', 'Beranda')
@section('content')
    <x-hero/>
    <!-- Section Fitur Utama -->
    <x-features/>
    <!-- Section FAQ dengan Accordion dan Animasi -->
    <x-faq/>
@endsection
