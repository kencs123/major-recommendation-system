@extends('layouts.app')

@section('title', 'Home')

@section('content')
<img src="{{ asset('images/home.jpg') }}" alt="Home" class="img-fluid">
<img src="{{ asset('images/home2.jpeg') }}" alt="Home2" class="img-fluid">
{{-- <div class="container py-5">

    <h2>Welcome to Major Recommendation System</h2>
    <p>Discover which major suits you best!</p>
</div> --}}
@endsection