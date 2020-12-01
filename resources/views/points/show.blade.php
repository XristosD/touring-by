@extends('layouts.app')

@section('google-api')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcmrS_jBbgfHGUuUJrsCg81ZdNwIWFtQg&callback=initMap&libraries=&v=weekly"
    defer></script>
@endsection
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0 align-self-center responsive-card-header-title">Point's Details</h5>
        <div class="dropdown" id="not-so-responsive-dropdown">
            <button class="btn my-btn btn-secondary dropdown-toggle mr-1 py-1" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu dropdown-menu-right m-0 p-0" aria-labelledby="dropdownMenuButton">
                <a href="/admin/points/{{ $point->id }}/edit" class="btn my-btn dropdown-item m-1" role="button"
                    aria-pressed="true">Edit</a>
                <form class="d-inline" action="/admin/points/{{ $point->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn my-btn dropdown-item m-1">Delete</button>
                </form>
            </div>
        </div>
        <div id="not-so-responsive-btns">
            <a href="/admin/points/{{ $point->id }}/edit" class="btn my-btn" role="button" aria-pressed="true">Edit</a>
            <form class="d-inline" action="/admin/points/{{ $point->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn my-btn">Delete</button>
            </form>
        </div>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <h6>Name:</h6>
            <span>{{ $point->name }}</span>
        </li>
        <li class="list-group-item">
            <h6>Description:</h6>
            <span>
                {{ $point->description }}
            </span>
        </li>
        <li class="list-group-item">
            <h6>Information:</h6>
            <span>
                {{ $point->info }}
            </span>
        </li>
        <li class="list-group-item d-flex justify-content-center">
            <img src="{{ $point->public_image_path() }}" width="auto" class="img-fluid" alt="" loading="lazy">
        </li>
    </ul>
</div>

<div class="card mt-3">
    <input type="hidden" id="latitude" value="{{ $point->latitude }}" name="latitude">
    <input type="hidden" id="longitude" value="{{ $point->longitude }}" name="longitude">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0 align-self-center responsive-card-header-title">Point's Location</h5>
        <div class="dropdown" id="not-so-responsive-dropdown">
            <button class="btn my-btn btn-secondary dropdown-toggle mr-1 py-1" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu dropdown-menu-right m-0 p-0" aria-labelledby="dropdownMenuButton">
                <a href="/admin/points/{{ $point->id }}/location" class="btn my-btn btn my-btn dropdown-item m-1" role="button" aria-pressed="true">Change</a>
            </div>
        </div>
        <div id="not-so-responsive-btns">
            <a href="/admin/points/{{ $point->id }}/location" class="btn my-btn btn my-btn" role="button" aria-pressed="true">Change</a>
        </div>
    </div>
    <div class="card-body h100">
        <div id="map"></div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0 align-self-center responsive-card-header-title">Point's Places</h5>
        <a href="#" class="btn my-btn responsive-card-header-btn" role="button" aria-pressed="true">Add/Remove</a>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
        </ul>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0 align-self-center responsive-card-header-title">Point's Tags</h5>
        <a href="#" class="btn my-btn responsive-card-header-btn" role="button" aria-pressed="true">Add/Remove</a>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="model-name-a">Cras justo odio</a>
            </li>
        </ul>
    </div>
</div>

@endsection