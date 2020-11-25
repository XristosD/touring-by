@extends('layouts.app')

@section('content')

<div class="btn-wrapper">
    <a href="/admin/places/create" class="btn btn-lg my-btn" role="button" aria-pressed="true">Add a new place</a>
</div>
<div class="places-wrapper">
    @empty($places)
        <div>
            <span>No places added yet!</span>
        </div>
    @endempty
    @foreach ($places as $place)
    <div class="row model-wrapper">
        <div class="col">
            <div class="row">
                <div class="col-sm-auto justify-content-center d-flex">
                    <a href="{{ $place->path() }}">
                    <img src="{{ $place->public_image_path() }}" width="120" height="120"
                            class="d-inline-block align-top" alt="" loading="lazy">
                    </a>
                </div>
                <div class="col-sm">
                    <div class="row h-100 align-items-center">
                        <div class="col-md model-name">
                            <a href="{{ $place->path() }}" class="model-name-a">
                                <h5>{{ $place->name }}</h5>
                            </a>
                        </div>
                        <div class="col-md model-info">
                            <h6>#points: 37</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col info-place">
                    {{ $place->info }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection