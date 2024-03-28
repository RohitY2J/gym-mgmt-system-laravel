@extends('layouts.admin_layout')

@section('content')

<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"> Add Category </div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.category.addcategory')}}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" required autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>





                        <div class="row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary px-4">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    @if(session('success'))
                    <div id="alert" class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-left mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Categories </div>
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->title}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <button class="btn btn-danger delete-btn-category"
                                    data-id="{{ $category->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection


    <script type="module">
    $(document).ready(function() {
        console.log("reached");
        $('.delete-btn-category').click(function() {
            console
            var categoryId = $(this).data('id');
            $.ajax({
                url: 'http://127.0.0.1:8000/admin/category/deletecategory/' + categoryId,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Refresh the page or update the UI as needed
                    console.log("Its a success");
                    location.reload();
                },
                error: function(xhr) {
                    console.log("Its a error");
                    console.log(xhr.responseText);
                    // Handle errors
                }
            });
        });
    });
    </script>