@extends('layouts.auth-master')

{{-- @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li> {{!! \Session::get('success') !!}}</li>
        </ul>
    </div>
@endif --}}

@section('content')
    <form method="post" action="{{ route('password.email') }}">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" required="required" autofocus>
            <label for="floatingName">Email</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Send Reset Link</button>
    </form>
    @include('auth.partials.copy')
@endsection