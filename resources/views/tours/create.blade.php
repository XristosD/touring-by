@extends('layouts.app')

@section('content')

<div>
    <h3>
        Add a new tour:
    </h3>
</div>
<form action="/admin/tours/create" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">Type the name:</label>
        <input type="text" class="form-control" id="" name="name" placeholder="Name" value="{{ old('name') }}">
        @error('name')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Type a description:</label>
        <textarea class="form-control" id="" name="description" rows="3">{{ old('description') }}</textarea>
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
        <label for="">Select a place</label>
        <select class="form-control" id="" size=7 name="place">
            @foreach($places as $place)
            <option value="{{ $place->id }}">{{ $place->name }}</option>
            @endforeach
        </select>
        @error('place')
        <small class="font-weight-bold text-danger">Place is required</small>
        @enderror
    </div>
    <div class="btn-wrapper">
        <button type="submit" class="btn btn-lg my-btn">Save</button>
    </div>
</form>

@endsection