@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">

    <form method="POST" action="/admin/" class="d-flex flex-column align-items-center">
        @csrf
        <h5 class="pb-3">Welcome</h5>
        <div class="pb-2">
            <span>Type your credentials</span>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="d-flex flex-column align-items-center">
            <button type="submit" class="btn my-btn">Login</button>
        </div>
        @if ($errors->any())
        <div>
            <small class="font-weight-bold text-danger">Credenentials are not accepted!</small>
        </div>
        @endif
    </form>

</div>

@endsection