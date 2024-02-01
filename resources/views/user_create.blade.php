@extends('master')

@section('content')

    <h2>Create</h2>

    @if ( session()->has('message') )
        {{ session()->get('message') }}
    @endif

    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Your name">
        <input type="text" name="email" placeholder="Your email">
        <input type="password" name="password" placeholder="Your password">
        <button type="submit">Create</button>
    </form>

@endsection
