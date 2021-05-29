@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm">
        <div class="card text-center index-card">
            <div class="card-body">
                <a href="/admin/places" class="index-a">
                    <i class="fas fa-globe"></i>
                    <h5 class="card-tilte">Places</h5>
                    <h6 class="card-subtitle">#{{ App\Models\Place::count() }}</h6>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card text-center index-card">
            <div class="card-body">
                <a href="/admin/points" class="index-a">
                    <i class="fas fa-map-marker-alt"></i>
                    <h5 class="card-tilte">Points</h5>
                    <h6 class="card-subtitle">#{{ App\Models\Point::count()  }}</h6>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="card text-center index-card">
            <div class="card-body">
                <a href="/admin/tours" class="index-a">
                    <i class="fas fa-route"></i>
                    <h5 class="card-tilte">Tours</h5>
                    <h6 class="card-subtitle">#{{ App\Models\Tour::count()  }}</h6>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card text-center index-card">
            <div class="card-body">
                <a href="#" class="index-a">
                    <i class="fas fa-user"></i>
                    <h5 class="card-tilte">Users</h5>
                    <h6 class="card-subtitle">#123</h6>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection