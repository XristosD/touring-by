@extends('layouts.app')

@section('google-api')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{config('maps.key')}}&callback=initAutocomplete&libraries=places&v=weekly"
    defer></script>
@endsection

@section('content')

<div>
    <h3>
        Change location for  <a href="{{ $point->path() }}" class="model-name-a">{{ $point->name }}</a>:
    </h3>
</div>
<form action="/admin/points/{{ $point->id }}/location" method="POST">
    @csrf
    <div class="form-group">
        @if ($errors->has('latitude') || $errors->has('longitude'))
        <div>
            <small class="font-weight-bold text-danger">please set a location for point. </small>
        </div>
        @endif
        <input type="hidden" id="latitude" value="{{ $point->latitude }}" name="latitude">
        <input type="hidden" id="longitude" value="{{ $point->longitude }}" name="longitude">

        <div class="card mt-3">
            <div class="card-body">
                <input id="pac-input" class="controls" type="text" placeholder="Search Box" />
                <div id="map"></div>
            </div>
        </div>
    </div>
    <div class="btn-wrapper">
        <button type="submit" class="btn btn-lg my-btn">Save</button>
    </div>
</form>

@endsection