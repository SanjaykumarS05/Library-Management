@extends('layout.template')

@section('title', 'Edit Member')
@include('style.editcss')

@section('content')
<h1 class="h1">Edit Member</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST" class="form">
    @csrf
    @method('PUT')

    {{-- Basic Info --}}
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}">
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
    </div>

    <div>
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        </select>
    </div>

    {{-- Profile Info --}}
    <h3 class="h3" style="display:block; margin-top:20px;">Profile Details</h3>

    <div>
        <label>Secondary Email:</label>
        <input type="email" name="secondary_email" value="{{ old('secondary_email', $user->profile->secondary_email ?? '') }}">
    </div>

    <div>
        <label>Blood Group:</label>
        <select name="blood_group">
            <option value="">Select Blood Group</option>
            @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                <option value="{{ $bg }}" {{ (old('blood_group', $user->profile->blood_group ?? '') == $bg) ? 'selected' : '' }}>
                    {{ $bg }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Date of Birth:</label>
        <input type="date" name="dob" value="{{ old('dob', $user->profile->dob ?? '') }}">
    </div>

    <div>
        <label>Gender:</label>
        <select name="gender">
            <option value="">Select Gender</option>
            @foreach(['male','female','other'] as $gender)
                <option value="{{ $gender }}" {{ (old('gender', $user->profile->gender ?? '') == $gender) ? 'selected' : '' }}>
                    {{ ucfirst($gender) }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Designation:</label>
        <input type="text" name="designation" value="{{ old('designation', $user->profile->designation ?? '') }}">
    </div>

    <div>
        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone', $user->profile->phone ?? '') }}" maxlength="10">
    </div>

    <div>
        <label>Address:</label>
        <input type="text" name="address" value="{{ old('address', $user->profile->address ?? '') }}">
    </div>

    <div>
        <label>Qualification:</label>
        <input type="text" name="qualification" value="{{ old('qualification', $user->profile->qualification ?? '') }}">
    </div>

    <button type="submit" class="button1">Update</button>
</form>
@endsection
