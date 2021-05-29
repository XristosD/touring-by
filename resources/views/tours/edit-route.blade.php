@extends('layouts.app')

@section('google-api')
<script
  src="https://maps.googleapis.com/maps/api/js?key={{config('maps.key')}}&callback=initTourMap&libraries=&v=weekly"
  defer></script>
@endsection
@section('content')



<div class="row">
  <div class="col">
    <h4 class="ml-3">Add or remove points for tour</h4>
    <input type="hidden" id="tour-id" value="{{ $tour->id }}">
  </div>
</div>
<div class="row">
  <div class="col">
    <form action="/admin/tours/{{ $tour->id }}/route" method="POST">
      @csrf
      <div id="map"></div>
      <div class="points-wrapper" id="pointsWrapper"></div>
      <div class="delete-point" id="removeLast">
        <button class="offset" onclick="removeLastPoint()" type="button">
          <i class="ico fas fa-minus-circle fa-2x"></i>
        </button>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn my-btn">Save</button>
      </div>
    </form>
  </div>
</div>
</div>

@endsection