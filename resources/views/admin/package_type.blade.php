@extends('layouts.admin_layout')

@section('content')

<x-modal-form-popup>
    Package Type
    <x-slot name="bodySlot">

        <div>
            <label for="category"> Category </label>
            <select name="category" class="form-select @error('category') is-invalid @enderror" id="category" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>

            @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mt-3">
            <label for="name"> Package Name </label>

            <div class="">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="mt-3">
            <label for="price"> Price </label>

            <div class="">
                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                    value="{{ old('price') }}" required autocomplete="price" autofocus>

                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-3">
            <label for="duration"> Duration </label>

            <div class="row">
                <div class="col-md-8">
                    <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror"
                        name="duration" value="{{ old('duration') }}" required autocomplete="duration" autofocus>

                    @error('duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    @php
                    $periodEnumArr = [
                    ['key' => '0', 'value' => 'Day'],
                    ['key' => '1', 'value' => 'Month'],
                    ['key' => '2', 'value' => 'Year']
                    ];
                    @endphp
                    <select name="period" class="form-select @error('period') is-invalid @enderror" id="period"
                        required>
                        <option value="">Select Period</option>
                        @foreach ($periodEnumArr as $periodEnum)
                        <option value="{{ $periodEnum["key"] }}">{{ $periodEnum["value"] }}</option>
                        @endforeach
                    </select>

                    @error('period')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

    </x-slot>

    <x-slot name="buttonSlot"> 
        <button class="btn btn-success"> Save </button>
    </x-slot>
</x-modal-form-popup>

<div class="container">
    <div class="row justify-content-left">

    </div>
    <div class="row justify-content-left">
        <div class="col-md-12">
            <h2> Package Type </h2>
            <div class="card">
                <div class="card-header">
                    <div class="navbar py-0" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <button class="text-button" data-bs-toggle="modal" data-bs-target="#formModal"> Add
                            </button>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @foreach($packages as $package)
                        <tr>
                            <td>{{$package->id}}</td>
                            <td>{{$package->id}}</td>
                            <td>{{$package->created_at}}</td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection