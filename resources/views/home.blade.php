@extends('layouts.layout')
@section('content')

<x-navbar></x-navbar>


@if(session('msg'))
    <h1>{{ session('msg') }} </h1>
@else
<h2>User Registration Form</h2>

<form action="/user" method="GET">
  <label for="username">Username:</label><br>
  <input type="text" id="username" name="username" required><br><br>

  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" required><br><br>

  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" required><br><br>

  <label for="confirm_password">Confirm Password:</label><br>
  <input type="password" id="confirm_password" name="confirm_password" required><br><br>

  <input type="submit" value="Register">
</form>
@endif