@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <h4 class="ml-3">Add or remove points for <a href="{{ $place->path() }} " class="model-name-a">{{ $place->name }}</a></h4>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card mt-3">
            <form action="/admin/places/{{ $place->id }}/add-points" method="POST">
                @csrf
                <div class="card-header">
                    <h6 class="mb-0">Check and add points</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush card-body-list-overflow">
                        @forelse($notBelongingPoints as $point)
                        <li class="list-group-item d-flex justify-content-between">
                            <label class="w-100 mb-0" for="vehicle1">{{ $point->name }}</label>
                            <input type="checkbox" class="align-self-center" id="vehicle1" name="addedPoints[]"
                                value="{{ $point->id }}">
                        </li>
                        @empty
                        <span>
                            Every point is related to place.
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
            <form action="/admin/places/{{ $place->id }}/remove-points" method="POST">
                @csrf
                <div class="card-header">
                    <h6 class="mb-0">Check and remove points</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush card-body-list-overflow">
                        @forelse($belongingPoints as $point)
                        <li class="list-group-item d-flex justify-content-between">
                            <label class="w-100 mb-0" for="vehicle1">{{ $point->name }}</label>
                            <input type="checkbox" class="align-self-center" id="" name="removedPoints[]"
                                value="{{ $point->id }}">
                        </li>
                        @empty
                        <span>
                            Place hasn't realated points yet.
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