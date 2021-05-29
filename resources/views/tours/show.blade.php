@extends('layouts.app')

@section('google-api')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{config('maps.key')}}&callback=initTourPointsMap&libraries=&v=weekly"
    defer></script>
@endsection
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div>
            <h5 class="mb-0 align-self-center responsive-card-header-title">Tour's Details</h5>
            @if (!$tour->has_points)
            <span class="badge badge-pill badge-warning">No points associated!</span>
            @endif
        </div>
        <div class="dropdown" id="not-so-responsive-dropdown">
            <button class="btn my-btn btn-secondary dropdown-toggle mr-1 py-1" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu dropdown-menu-right m-0 p-0" aria-labelledby="dropdownMenuButton">
                <a href="/admin/tours/{{ $tour->id }}/edit" class="btn my-btn dropdown-item m-1" role="button"
                    aria-pressed="true">Edit</a>
                <form class="d-inline" action="/admin/tours/{{ $tour->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" disabled class="btn my-btn dropdown-item m-1">Delete</button>
                </form>
            </div>
        </div>
        <div id="not-so-responsive-btns">
            <a href="/admin/tours/{{ $tour->id }}/edit" class="btn my-btn" role="button" aria-pressed="true">Edit</a>
            <form class="d-inline" action="/admin/tours/{{ $tour->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" disabled class="btn my-btn">Delete</button>
            </form>
        </div>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <h6>Name:</h6>
            <span>{{ $tour->name }}</span>
        </li>
        <li class="list-group-item">
            <h6>Description:</h6>
            <span>
                {{ $tour->description }}
            </span>
        </li>
        <li class="list-group-item">
            <h6>Information:</h6>
            <span>
                {{ $tour->info }}
            </span>
        </li>
        <li class="list-group-item">
            <h6>Associated place:</h6>
            <span>
                {{ $tour->place->name }}
            </span>
        </li>
    </ul>
</div>

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0 align-self-center responsive-card-header-title">tour's points and route</h5>
        <input type="hidden" id="tour-id" value="{{ $tour->id }}">
        <div class="dropdown" id="not-so-responsive-dropdown">
            <button class="btn my-btn btn-secondary dropdown-toggle mr-1 py-1" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu dropdown-menu-right m-0 p-0" aria-labelledby="dropdownMenuButton">
                <a href="/admin/tours/{{ $tour->id }}/edit-route" class="btn my-btn btn my-btn dropdown-item m-1"
                    role="button" aria-pressed="true">Change</a>
            </div>
        </div>
        <div id="not-so-responsive-btns">
            <a href="/admin/tours/{{ $tour->id }}/edit-route" class="btn my-btn btn my-btn" role="button"
                aria-pressed="true">Change</a>
        </div>
    </div>

    <div class="card-body h100">
        @if ($tour->has_points)
        <div id="map"></div>
        @else
        <div>No associatef points!</div>
        @endif
    </div>

</div>


@endsection