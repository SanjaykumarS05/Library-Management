@extends('layout.template')
@section('title', 'Add Member')
@section('header')
    <h1>Add Member</h1>
@endsection

@section('content')

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="checkbox" onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show Password
    </div>
    <div>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            
        </select>
        <div>
    <button type="submit">Add Member</button>
    </div>
    <script>
           @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>
@endsection

