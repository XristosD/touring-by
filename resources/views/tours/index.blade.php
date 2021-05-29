@extends('layouts.app')

@section('content')

<div class="btn-wrapper">
    <a href="/admin/tours/create" class="btn btn-lg my-btn" role="button" aria-pressed="true">Add a new tour</a>
</div>
<div class="">
    @if($tours->isEmpty())
    <div>
        <span>No tours added yet!</span>
    </div>
    @endif
    @foreach ($tours as $tour)
    <div class="row model-wrapper">
        <div class="col">
            <div class="row">
                <div class="col-sm">
                    <div class="row h-100 align-items-center">
                        <div class="col-md model-name">
                            <a href="{{ $tour->path() }}" class="model-name-a">
                                <h5>{{ $tour->name }}</h5>
                            </a>
                        </div>
                        <div class="col-md model-info justify-content-center">
                            <h6>#points: {{$tour->points()->count()}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md model-name">
                    <span>
                        Associated place:
                        <a href="{{ $tour->place->path() }}" class="model-name-a">
                            <span>{{ $tour->place->name }}</span>
                        </a>
                    </span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col info-place">
                    {{ $tour->info }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection