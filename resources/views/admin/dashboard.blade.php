@extends('layout.template')
@section('title', 'Admin Dashboard')
@section('header')
    <h1>Admin Dashboard</h1>
@endsection
@section('content')
    <p>Welcome to the Admin Dashboard!</p>
    <h1>Welcome, Admin {{ Auth::user()->name }}</h1>
 <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    <nav>
        <a href="{{ route('admin.books') }}">Manage Books</a> |
        <a href="{{ route('admin.manage_users') }}">Manage Users</a> |
    </nav>
    <div>
        <h2>Admin Actions</h2>
        <ul>
            <li><a href="{{ route('admin.books') }}">View All Books</a></li>
        </ul>
    </div>
@endsection
