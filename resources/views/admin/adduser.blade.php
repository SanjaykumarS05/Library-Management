@extends('layout.template')
@section('title', 'Add Member')
@include('Style.addcss')

@section('content')
<div class="container">
    <h1 class="h1">➕ Add Member</h1>

    <form action="{{ route('users.store') }}" class="form" method="POST">
        @csrf

        {{-- Basic Info --}}
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
                <option value="">Select Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        {{-- Admin Info Display --}}
        <div>
            <label>Added By (Admin Name):</label>
            <input type="text" value="{{ $admin->name }}" readonly>
        </div>

        <h3 class="h3" style="display: block;">Profile Details</h3>

        <div>
            <label>Secondary Email:</label>
            <input type="email" name="secondary_email" value="{{ old('secondary_email') }}">
        </div>

        <div>
            <label>Blood Group:</label>
            <select name="blood_group">
                <option value="">Select Blood Group</option>
                @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                    <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>
                        {{ $bg }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Date of Birth:</label>
            <input type="date" name="dob" value="{{ old('dob') }}">
        </div>

        <div>
            <label>Gender:</label>
            <select name="gender">
                <option value="">Select gender</option>
                @foreach(['male','female','other'] as $gender)
                    <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : '' }}>
                        {{ ucfirst($gender) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Designation:</label>
            <input type="text" name="designation" value="{{ old('designation') }}">
        </div>

        <div>
            <label>Phone:</label>
            <input type="text" name="phone" value="{{ old('phone') }}">
        </div>

        <div>
            <label>Address:</label>
            <input type="text" name="address" value="{{ old('address') }}">
        </div>

        <div>
            <label>Qualification:</label>
            <input type="text" name="qualification" value="{{ old('qualification') }}">
        </div>

        <button type="submit" class="button1">Add Member</button>
    </form>
</div>
@endsection
