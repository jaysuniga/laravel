@extends('layouts.layout')
@section('content')
    <div class="p-5"></div>
    <div class="container my-5 p-5 w-25 border rounded-4">
        <div class="mb-3 text-center">
        <h2>REGISTER</h2>
        </div>
        <form action="{{route('registerHandler')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <a href="{{route('login')}}">Already registered?</a>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
@endsection
