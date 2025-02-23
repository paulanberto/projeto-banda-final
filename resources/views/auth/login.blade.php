@extends('layouts.fo_layout')
@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
@endsection
