@extends('layouts.app')

@section('google-api')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcmrS_jBbgfHGUuUJrsCg81ZdNwIWFtQg&callback=initAutocomplete&libraries=places&v=weekly"
    defer></script>
@endsection

@section('content')

<div>
    <h3>
        Add a new point:
    </h3>
</div>
<form action="/admin/points/create" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">Type the name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name"
            value="{{ old('name') }}">
        @error('name')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Type a description:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description"
            rows="3">{{ old('description') }}</textarea>
        @error('description')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Type any extra information:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="info"
            rows="2">{{ old('info') }}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Choose an image:</label>
        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1"
            value="{{ old('image') }}">
        @error('image')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
        @enderror
        @if ($errors->has('upload problem'))
        <div>
            <small class="font-weight-bold text-danger">{{ $errors->get('upload problem')[0] }} </small>
        </div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Choose a location for point:</label>
        @if ($errors->has('latitude') || $errors->has('longitude'))
        <div>
            <small class="font-weight-bold text-danger">please set a location for point. </small>
        </div>
        @endif
        <input type="hidden" id="latitude" value="{{ old('latitude') }}" name="latitude">
        <input type="hidden" id="longitude" value="{{ old('longitude') }}" name="longitude">

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