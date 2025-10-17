@extends('layout.usertemplate')
@section('title', 'Settings')
@include('style.settingcss')

{{-- CSRF meta for AJAX --}}
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<h2>Settings</h2>

<div class="setting-toggle">
    <label><input type="checkbox" id="toggle-profile" checked> Profile</label>
    <label><input type="checkbox" id="toggle-password"> Change Password</label>
</div>
<div class="container setting">

    {{-- ==================== PROFILE FORM ==================== --}}
    <form id="profile-form" action="{{ route('user.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h3>Profile Settings</h3>

        <div>
            <img id="profilePreview"
                 src="{{ Auth::user()->profile?->profile_image_path ? asset('storage/' . Auth::user()->profile->profile_image_path) : asset('images/default.png') }}"
                 class="profile-image" alt="Profile">
            <input type="file" name="profile_image" id="profile_image" accept="image/*">
        </div>

        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $admin->name) }}">
        </div>
        <div>
            <label>User ID:</label>
            <input type="text" value="{{ $admin->id }}" readonly>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $admin->email) }}">
        </div>
        <div>
            <label>Secondary Email:</label>
            <input type="email" name="secondary_email" value="{{ old('secondary_email', $admin->profile->secondary_email ?? '') }}">
        </div>
        <div>
            <label>Blood Group:</label>
            <select name="blood_group">
                <option value="">Select Blood Group</option>
                @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                    <option value="{{ $bg }}" {{ (old('blood_group', $admin->profile->blood_group ?? '') == $bg) ? 'selected' : '' }}>{{ $bg }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Date of Birth:</label>
            <input type="date" name="dob" value="{{ old('dob', $admin->profile->dob ?? '') }}">
        </div>
        <div>
            <label>Gender:</label>
            <select name="gender">
                <option value="">Select gender</option>
                @foreach(['male','female','other'] as $gender)
                    <option value="{{ $gender }}" {{ (old('gender', $admin->profile->gender ?? '') == $gender) ? 'selected' : '' }}>{{ ucfirst($gender) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Designation:</label>
            <input type="text" name="designation" value="{{ old('designation', $admin->profile->designation ?? '') }}">
        </div>
        <div>
            <label>Phone:</label>
            <input type="text" name="phone" value="{{ old('phone', $admin->profile->phone ?? '') }}" maxlength="10">
        </div>
        <div>
            <label>Address:</label>
            <input type="text" name="address" value="{{ old('address', $admin->profile->address ?? '') }}">
        </div>
        <div>
            <label>Qualification:</label>
            <input type="text" name="qualification" value="{{ old('qualification', $admin->profile->qualification ?? '') }}">
        </div>

        <button type="submit" class="button1">Update Profile</button>
    </form>

    {{-- ==================== PASSWORD FORM ==================== --}}
    <form id="password-form" action="{{ route('user.settings.password') }}" method="POST" style="display:none;">
        @csrf
        @method('PUT')
        <h3>Change Password</h3>

        <div>
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password">
        </div>
        <div>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password">
        </div>
        <div>
            <label for="new_password_confirmation">Confirm New Password:</label>
            <input type="password" name="new_password_confirmation">
        </div>

        <button type="submit" class="button1">Change Password</button>
    </form>

</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

    // ===== CSRF Setup =====
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // ===== Toggle Forms =====
    function toggleForm(showFormId) {
        const forms = ['#profile-form', '#password-form'];
        const toggles = ['#toggle-profile', '#toggle-password'];

        forms.forEach((form, index) => {
            if(form === showFormId) $(form).slideDown(); else $(form).slideUp();
        });
        toggles.forEach((toggle, index) => {
            if(forms[index] === showFormId) $(toggle).prop('checked', true); else $(toggle).prop('checked', false);
        });
    }

    $('#toggle-profile').on('change', function() {
        if(this.checked) toggleForm('#profile-form'); else $('#profile-form').slideUp();
    });

    $('#toggle-password').on('change', function() {
        if(this.checked) toggleForm('#password-form'); else $('#password-form').slideUp();
    });

    // ===== Profile Image Preview =====
    $('#profile_image').on('change', function() {
        const [file] = this.files;
        if(file) $('#profilePreview').attr('src', URL.createObjectURL(file));
    });

    // ===== AJAX Form Submission =====
    function ajaxSubmit(formId) {
        $(formId).on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message || 'Saved successfully!');
                    form[0].reset(); // optional: reset form
                },
                error: function(xhr) {
                    if(xhr.status === 422 && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else if(xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('Something went wrong!');
                    }
                }
            });
        });
    }

    ajaxSubmit('#profile-form');
    ajaxSubmit('#password-form');
});
</script>
@endsection
