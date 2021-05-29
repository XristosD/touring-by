@extends('layouts.app')

@section('google-api')
<script
src="https://maps.googleapis.com/maps/api/js?key={{config('maps.key')}}&callback=initAutocomplete&libraries=places&v=weekly"
defer></script>
@endsection

@section('content')

<div class="row">
  <div class="col">
    <h4 class="ml-3">Change location for  <a href="{{ $point->path() }}" class="model-name-a">{{ $point->name }}</a></h4>
  </div>
</div>
<div class="row">
  <div class="col">
    <div class="card mt-3">
      <div class="card-header">
        <h6 class="mb-0">Search a location by searhbox or manually</h6>
      </div>
      <div class="card-body">
        <input id="pac-input" class="controls" type="text" placeholder="Search Box" />
        <div id="map"></div>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <form action="#">
          <input type="hidden" id="position">
          <input type="submit" value="Save" class="btn my-btn responsive-card-header-btn" disabled role="button"
            aria-pressed="true" id="submitPosition">
        </form>
      </div>
    </div>
  </div>
</div>

@endsection