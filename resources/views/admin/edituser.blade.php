@extends('layout.template')
@section('title', 'Edit Member')
@section('header')
    <h1>Edit Member</h1>
@endsection

@section('content')

 <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        </select>

        <button type="submit">Update</button>
    </form>

@endsection

