@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0 align-self-center responsive-card-header-title">Place's Details</h5>
        <div class="dropdown" id="not-so-responsive-dropdown">
            <button class="btn my-btn btn-secondary dropdown-toggle mr-1 py-1" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu dropdown-menu-right m-0 p-0" aria-labelledby="dropdownMenuButton">
                <a href="/admin/places/{{ $place->id }}/edit" class="btn my-btn dropdown-item m-1" role="button"
                    aria-pressed="true">Edit</a>
                <form class="d-inline" action="/admin/places/{{ $place->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn my-btn dropdown-item m-1">Delete</button>
                </form>
            </div>
        </div>
        <div id="not-so-responsive-btns">
            <a href="/admin/places/{{ $place->id }}/edit" class="btn my-btn" role="button" aria-pressed="true">Edit</a>
            <form class="d-inline" action="/admin/places/{{ $place->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn my-btn">Delete</button>
            </form>
        </div>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <h6>Name:</h6>
            <span>{{ $place->name }}</span>
        </li>
        <li class="list-group-item">
            <h6>Description:</h6>
            <span>
                {{ $place->description }}
            </span>
        </li>
        <li class="list-group-item">
            <h6>Information:</h6>
            <span>
                {{ $place->info }}
            </span>
        </li>
        <li class="list-group-item d-flex justify-content-center">
            <img src="{{ $place->public_image_path() }}" width="auto" class="img-fluid" alt="" loading="lazy">
        </li>
    </ul>
</div>

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0 align-self-center responsive-card-header-title">Place's Points</h5>
        <div class="dropdown" id="not-so-responsive-dropdown">
            <button class="btn my-btn btn-secondary dropdown-toggle mr-1 py-1" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu dropdown-menu-right m-0 p-0" aria-labelledby="dropdownMenuButton">
                <a href="#" class="btn my-btn dropdown-item m-1" role="button" aria-pressed="true">Add/Remove</a>
            </div>
        </div>
        <div id="not-so-responsive-btns">
        <a href="/admin/places/{{ $place->id }}/edit-points" class="btn my-btn" role="button" aria-pressed="true">Add/Remove</a>
        </div>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @foreach( $place->points as $point)
            <li class="list-group-item">
            <a href="{{ $point->path() }}" class="model-name-a">{{ $point->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>


    @endsection