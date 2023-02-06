@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1 style="align-items: center;">Flight List</h1>
        
        @foreach ($flights as $flight)
            <li>{{ $flight->title }}</li>
        @endforeach
        {{-- <p>{{$flights->links()}}</p> --}}
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection