@extends('layouts.app')
@section('content')

<div class="container">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img height="500px" src="{{URL::asset('/image/fitness-pic-1.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img height="500px" src="{{URL::asset('/image/fitness-pic-2.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img height="500px" src="{{URL::asset('/image/fitness-pic-3.jpg')}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @auth
        
    @endauth
</div>

@endsection