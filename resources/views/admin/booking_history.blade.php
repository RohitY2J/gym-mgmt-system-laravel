@extends('layouts.admin_layout')

@section('content')

<x-modal-form-popup>
    Add Payment
    <x-slot name="bodySlot">
        <form method="POST" action="{{ route('admin.booking_history.add_payment') }}" id="myForm">
            @csrf
            <div>
                <input id="id" type="text" class="form-control" name="id" style="display: none">

            </div>
            <label for="payment"> Amount </label>

            <div class="">
                <input id="payment" type="text" class="form-control @error('payment') is-invalid @enderror"
                    name="payment" required autocomplete="payment">

                @error('payment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mt-3">
                <label for="startDate"> Start Date </label>

                <div class="">
                    <input id="startDate" type="date" class="form-control @error('startDate') is-invalid @enderror"
                        name="startDate" required autocomplete="startDate">

                    @error('startDate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <label for="endDate"> End Date </label>

                <div class="">
                    <input id="endDate" type="date" class="form-control @error('endDate') is-invalid @enderror"
                        name="endDate" required autocomplete="endDate">

                    @error('endDate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </form>


    </x-slot>

    <x-slot name="buttonSlot">
        <button type="submit" class="btn btn-success" id="submitButton"> Add Payment </button>
    </x-slot>
</x-modal-form-popup>

<div class="container">
    <div class="row justify-content-left">

    </div>
    <div class="row justify-content-left">
        <div class="col-md-12">
            <h2> Bookings </h2>
            <div class="card">
                <div class="card-header">
                    <div class="navbar py-0" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <!-- <ul class="navbar-nav ms-auto">
                            <button class="text-button"> Add
                            </button>
                        </ul> -->
                    </div>
                </div>
                <div class="card-body">
                    <table id="data-table" style="width: 100%;">
                        <tr>
                            <th>Booking Id</th>
                            <th>Booked Date</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Package Name</th>
                            <th>Price</th>
                            <th>Payment</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>Expiry Date</th>
                        </tr>
                        @foreach($usersWithBookingHistory as $bookingHistory)
                        <tr style="{{ $bookingHistory->active_status == 1 ? 'background:#7cf28e;' : '' }}">
                            <td>{{$bookingHistory->id}}</td>
                            <td>{{$bookingHistory->created_at ? $bookingHistory->created_at : 'N/A'}}</td>
                            <td>{{$bookingHistory->username}}</td>
                            <td>{{$bookingHistory->email}}</td>
                            <td>{{$bookingHistory->packagename}}</td>
                            <td>{{$bookingHistory->packageprice}}</td>
                            <td
                                style="background: {{ $bookingHistory->payment_amount == $bookingHistory->packageprice ? '' : 'red' }}">
                                {{$bookingHistory->payment_amount}}
                            </td>
                            <td>{{$bookingHistory->description}}</td>
                            <td>{{$bookingHistory->starting_date ? $bookingHistory->starting_date : 'N/A'}}</td>
                            <td>{{ $bookingHistory->ending_date ? $bookingHistory->ending_date : 'N/A' }}</td>

                            <td>
                                <button class="no-border" {{ $bookingHistory->active_status == 1 ? 'disabled' : '' }}>
                                    <i class="bi bi-trash"
                                        style="color: {{ $bookingHistory->active_status == 1 ? 'grey' : 'red' }}"></i>
                                </button>
                                <button class="no-border" data-bs-toggle="modal" data-bs-target="#formModal"><i
                                        class="bi bi-pen edit-btn" style="color:green"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        console.log("document is ready")
        document.getElementById('submitButton').addEventListener('click', function() {
            document.getElementById('myForm').submit();
        });

        $('#data-table').on('click', '.edit-btn', function() {
            console.log("Edit button clicked")
            var row = $(this).closest('tr');
            var rowData = {
                id: row.find('td:eq(0)').text(),
                // user: row.find('td:eq(2)').text(),
                // email: row.find('td:eq(3)').text(), // Assuming the first cell contains data for field1
                // packageName: row.find('td:eq(4)').text(), // Assuming the second cell contains data for field2
                paymentAmount: row.find('td:eq(6)').text()
            };

            // Populate form fields
            $('#id').val(rowData.id);
            //$('#payment').val(rowData.paymentAmount);
            // Populate more fields as needed

            $("#formModal").show();

        });
    });
    </script>
    @endsection