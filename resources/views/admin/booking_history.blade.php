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
                        <ul class="navbar-nav me-auto" style="display: block">
                            <li class="nav-item" style="display: inline-block">Show</li>
                            <li class="nav-item" style="display: inline-block">
                                <select name="pagination" class="form-select" id="pagination" required>
                                    @foreach (range(10, 200, 10) as $number)
                                    <option value="{{ $number }}">{{ $number }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li style="display: inline-block">Entries</li>

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto" style="display: block">
                            <li class="ms-4 d-inline-block">Active Status</li>
                            <li style="display: inline-block">
                                <select name="active" class="form-select" id="active" required>
                                    <option value="{{null}}">All</option>
                                    @foreach ($activeStatus as $status)
                                    <option value="{{ $status["key"] }}">{{ $status["value"] }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li class="ms-2 d-inline-block">User</li>
                            <li style="display: inline-block">
                                <select name="user" class="form-select" id="user" required>
                                    <option value="{{null}}">All</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user["id"] }}">{{ $user["name"] }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li class="ms-2 d-inline-block">Payment</li>
                            <li style="display: inline-block">
                                <select name="payment" class="form-select" id="payment" required>
                                    <option value="{{null}}">All</option>
                                    @foreach ($payments as $payment)
                                    <option value="{{ $payment["key"] }}">{{ $payment["value"] }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li class="d-inline-block ms-2">
                                <button class="btn btn-success" id="fetchBookings">Apply</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <table id="data-table" style="width: 100%;">
                        <thead>
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
                        </thead>
                        <tbody id="data-table-body">
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
                                    <button class="no-border"
                                        {{ $bookingHistory->active_status == 1 ? 'disabled' : '' }}>
                                        <i class="bi bi-trash"
                                            style="color: {{ $bookingHistory->active_status == 1 ? 'grey' : 'red' }}"></i>
                                    </button>
                                    <button class="no-border" data-bs-toggle="modal" data-bs-target="#formModal"><i
                                            class="bi bi-pen edit-btn" style="color:green"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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

        $('#fetchBookings').click(function() {
            // Send an AJAX request to your Laravel backend

            var requestData = {
                pagination: $('#pagination').val(),
                payment: $('#payment').val(),
                user: $('#user').val(),
                active: $('#active').val()
            };

            $.ajax({
                url: '/admin/bookings/filter', // Update the URL to match your Laravel route
                type: 'Post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: requestData, // Pass the parameters here
                success: function(response) {
                    // Check if the response contains filtered data
                    if (response.usersWithBookingHistory) {
                        // Clear existing table rows
                        $('#data-table-body').empty();

                        // Iterate through the filtered data and append table rows
                        $.each(response.usersWithBookingHistory, function(index,
                            bookingHistory) {
                            var row = '<tr style="' + (bookingHistory
                                    .active_status == 1 ? 'background:#7cf28e;' : ''
                                ) + '">' +
                                '<td>' + bookingHistory.id + '</td>' +
                                '<td>' + (bookingHistory.created_at ? bookingHistory
                                    .created_at : 'N/A') + '</td>' +
                                '<td>' + bookingHistory.username + '</td>' +
                                '<td>' + bookingHistory.email + '</td>' +
                                '<td>' + bookingHistory.packagename + '</td>' +
                                '<td>' + bookingHistory.packageprice + '</td>' +
                                '<td style="background: ' + (bookingHistory
                                    .payment_amount == bookingHistory.packageprice ?
                                    '' : 'red') + '">' + bookingHistory
                                .payment_amount + '</td>' +
                                '<td>' + bookingHistory.description + '</td>' +
                                '<td>' + (bookingHistory.starting_date ?
                                    bookingHistory.starting_date : 'N/A') +
                                '</td>' +
                                '<td>' + (bookingHistory.ending_date ?
                                    bookingHistory.ending_date : 'N/A') + '</td>' +
                                '<td>' +
                                '<button class="no-border" ' + (bookingHistory
                                    .active_status == 1 ? 'disabled' : '') +
                                '><i class="bi bi-trash" style="color: ' + (
                                    bookingHistory.active_status == 1 ? 'grey' :
                                    'red') + '"></i></button>' +
                                '<button class="no-border" data-bs-toggle="modal" data-bs-target="#formModal"><i class="bi bi-pen edit-btn" style="color:green"></i></button>' +
                                '</td>' +
                                '</tr>';
                            $('#data-table-body').append(row);
                        });
                    } else {
                        console.log('No filtered data found');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    console.log('Error occurred while fetching filtered data');
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>
    @endsection