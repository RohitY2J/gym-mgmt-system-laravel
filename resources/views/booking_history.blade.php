@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Booking History</h2>

    <table style="width: 100%;">
        <!-- <colgroup>
        <col span="3">
        <col span="2" style="background-color: pink">
    </colgroup> -->
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Package Name</th>
            <th>Package Price</th>
            <th>Package Duration</th>
        </tr>
        @foreach($usersWithBookingHistory as $history)
        <tr>
            <td>{{$history->name}}</td>
            <td>{{$history->email}}</td>
            <td>N/A</td>
            <td>{{$history->price}}</td>
            <td>{{$history->duration}} {{$statuses[$history->time_unit]}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection