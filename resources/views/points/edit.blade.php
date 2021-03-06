@extends('layouts.app')

@section('google-api')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{config('maps.key')}}&callback=initAutocomplete&libraries=places&v=weekly"
    defer></script>
@endsection

@section('content')

<div>
    <h3>
        Edit point:
    </h3>
</div>
<form action="/admin/points/{{ $point->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleFormControlInput1">Type the name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name"
            value="{{ old('name', $point->name) }}">
        @error('name')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Type a description:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description"
            rows="3">{{ old('description', $point->description) }}</textarea>
        @error('description')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Type any extra information:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="info"
            rows="2">{{ old('info', $point->info) }}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Choose a new image (choose nothing to keep the same):</label>
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
    <div class="btn-wrapper">
        <button type="submit" class="btn btn-lg my-btn">Save</button>
    </div>
</form>

@endsection