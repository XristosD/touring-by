@extends('layouts.app')

@section('content')

<div class="btn-wrapper">
  <a href="/admin/points/create" class="btn btn-lg my-btn" role="button" aria-pressed="true">Add a new point</a>
</div>
<div class="">
  @if($points->isEmpty())
  <div>
    <span>No points added yet!</span>
  </div>
  @endif
  @foreach ($points as $point)
  <div class="row model-wrapper">
    <div class="col">
      <div class="row">
        <div class="col-sm-auto justify-content-center d-flex">
          <a href="{{ $point->path() }}">
            <img src="{{ $point->image }}" width="120" height="120" class="d-inline-block align-top"
              alt="" loading="lazy">
          </a>
        </div>
        <div class="col-sm">
          <div class="row h-100 align-items-center">
            <div class="col-md model-name">
              <a href="{{ $point->path() }}" class="model-name-a">
                <h5>{{ $point->name }}</h5>
              </a>
            </div>
            <div class="col-md model-info justify-content-center">
              <div class="d-flex flex-column">
                <h6>#places: {{ $point->places_count }}</h6>
                <h6>#tours: {{ $point->tours()->count() }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-1">
        <div class="col info-place">
          {{ $point->info }}
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

@endsection