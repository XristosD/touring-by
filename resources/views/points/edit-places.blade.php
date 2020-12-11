@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <h4 class="ml-3">Add or remove places for <a href="{{ $point->path() }}" class="model-name-a">{{ $point->name }}</a></h4>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card mt-3">
            <form action="/admin/points/{{ $point->id }}/add-places" method="POST">
                @csrf
                <div class="card-header">
                    <h6 class="mb-0">Check and add places</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush card-body-list-overflow">
                        @forelse($notBelongingPlaces as $place)
                        <li class="list-group-item d-flex justify-content-between">
                            <label class="w-100 mb-0" for="vehicle1">{{ $place->name }}</label>
                            <input type="checkbox" class="align-self-center" id="vehicle1" name="addedPlaces[]"
                                value="{{ $place->id }}">
                        </li>
                        @empty
                        <span>
                            Every place is related to point.
                        </span>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-lg my-btn">Add</button>
                </div>
            </form>
        </div>
        <div class="card mt-3">
            <form action="/admin/points/{{ $point->id }}/remove-places" method="POST">
                @csrf
                <div class="card-header">
                    <h6 class="mb-0">Check and remove places</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush card-body-list-overflow">
                        @forelse($belongingPlaces as $place)
                        <li class="list-group-item d-flex justify-content-between">
                            <label class="w-100 mb-0" for="vehicle1">{{ $place->name }}</label>
                            <input type="checkbox" class="align-self-center" id="" name="removedPlaces[]"
                                value="{{ $place->id }}">
                        </li>
                        @empty
                        <span>
                            Point hasn't realated places yet.
                        </span>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-lg my-btn">Remove</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection