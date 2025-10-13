@extends('layout.template')
@section('title', 'Settings')
@include('style.addcss')

{{-- CSRF meta for AJAX --}}
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<h2>Settings</h2>

<div class="setting-toggle">
    <label><input type="checkbox" id="toggle-profile" checked> Profile</label>
    <label><input type="checkbox" id="toggle-library"> Library</label>
</div>

<div class="container setting">

    {{-- ================= PROFILE FORM ================= --}}
    <form id="profile-form" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h3>Profile Settings</h3>

        {{-- Profile Image --}}
        <div>
            <img id="profilePreview" src="{{ $admin->profile->profile_image_path ? asset('storage/'.$admin->profile->profile_image_path) : asset('default.png') }}" alt="Profile Image" width="120">
            <input type="file" name="profile_image" id="profile_image" accept="image/*">
        </div>

        {{-- User Fields --}}
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $admin->name) }}" required>
        </div>
        <div>
            <label>User ID:</label>
            <input type="text" value="{{ $admin->id }}" readonly>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $admin->email) }}" required>
        </div>

        {{-- Profile Fields --}}
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
            <input type="text" name="phone" value="{{ old('phone', $admin->profile->phone ?? '') }}">
        </div>
        <div>
            <label>Address:</label>
            <input type="text" name="address" value="{{ old('address', $admin->profile->address ?? '') }}">
        </div>
        <div>
            <label>Qualification:</label>
            <input type="text" name="qualification" value="{{ old('qualification', $admin->profile->qualification ?? '') }}">
        </div>

        <button type="submit">Update Profile</button>
    </form>

    {{-- ================= LIBRARY FORM ================= --}}
    <form id="library-form" action="{{ route('library.update') }}" method="POST" enctype="multipart/form-data" style="display:none;">
        @csrf
        @method('PUT')
        <h3>Library Settings</h3>

        <div>
            <label>Library Name:</label>
            <input type="text" name="library_name" value="{{ $settings->library_name ?? '' }}" required>
        </div>
        <div>
            <label>Address:</label>
            <input type="text" name="address" value="{{ $settings->address ?? '' }}" required>
        </div>
        <div>
            <label>Contact Email:</label>
            <input type="email" name="contact_email" value="{{ $settings->contact_email ?? '' }}" required>
        </div>
        <div>
            <label>Contact Phone:</label>
            <input type="text" name="contact_phone" value="{{ $settings->contact_phone ?? '' }}" required>
        </div>
        <div>
            <label>Website:</label>
            <input type="text" name="web_site" value="{{ $settings->website ?? '' }}">
        </div>
        <div>
            <label>Instagram:</label>
            <input type="text" name="instagram" value="{{ $settings->instagram ?? '' }}">
        </div>
        <div>
            <label>Facebook:</label>
            <input type="text" name="facebook" value="{{ $settings->facebook ?? '' }}">
        </div>
        <div>
            <label>Twitter:</label>
            <input type="text" name="twitter" value="{{ $settings->twitter ?? '' }}">
        </div>
        <div>
            <label>LinkedIn:</label>
            <input type="text" name="linkedin" value="{{ $settings->linkedin ?? '' }}">
        </div>
        <div>
            <label>YouTube:</label>
            <input type="text" name="youtube" value="{{ $settings->youtube ?? '' }}">
        </div>
        <div>
            <label>Working Hours:</label>
            <input type="text" name="working_hours" value="{{ $settings->working_hours ?? '' }}" required>
        </div>

        <button type="submit">Update Library</button>
    </form>

</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // CSRF setup
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Toggle Forms
    $('#toggle-profile').change(function() {
        $('#profile-form').slideToggle(this.checked);
        if(this.checked) { $('#toggle-library').prop('checked', false); $('#library-form').slideUp(); }
    });

    $('#toggle-library').change(function() {
        $('#library-form').slideToggle(this.checked);
        if(this.checked) { $('#toggle-profile').prop('checked', false); $('#profile-form').slideUp(); }
    });

    // Profile Image Preview
    $('#profile_image').change(function() {
        const [file] = this.files;
        if(file) {
            $('#profilePreview').attr('src', URL.createObjectURL(file));
        }
    });

    // AJAX Form Submission
    function ajaxSubmit(form) {
        form.on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // Debug exact error
                    if(xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Something went wrong!');
                    }
                }
            });
        });
    }

    ajaxSubmit($('#profile-form'));
    ajaxSubmit($('#library-form'));
});
</script>
@endsection
