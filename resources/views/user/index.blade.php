@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1 style="align-items: center;">User List</h1>
        
        @foreach ($users as $user)
            <li>{{ $user->email }}</li>
        @endforeach
        
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection