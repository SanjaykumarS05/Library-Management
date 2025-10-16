@extends('layout.template')
@section('title', 'Manage Users')
@include ('style.managebookcss')

@section('content')
<h2 class="h2">Manage Users</h2>

<!-- Search & Filters -->
<form method="GET" action="" class="search-form" id="book-search-form">
<div class="form-group">
    <input type="text"  id="search-name" placeholder="Search by Name or Email" style="padding:5px; width:150%; position:relative; left:-92px;">

    <select id="role" style="padding:5px;position:relative; left:-92px;">
        <option value="">All Roles</option>
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
        <option value="member">Member</option>
    </select>
</div>
</form>
    <a href="{{ route('users.create') }}" class="addbook">╋ Add Member</a>
    <a href="{{ route('users') }}" class="btn btn-secondary">Reset</a>
    <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
    <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>

<!-- Users Table -->
<div id="report-table">
    @include('admin.users_table', ['users' => $users])
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function fetchUsers() {
        let name = $('#search-name').val();
        let email = $('#search-email').val();
        let role = $('#role').val();

        $.ajax({
            url: "{{ route('users') }}",
            type: 'GET',
            data: { name: name, email: email, role: role },
            success: function(response) {
                $('#report-table').html(response);
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    // Trigger AJAX on input or select change
    $('#search-name, #search-email, #role').on('keyup change', fetchUsers);
});
</script>
@endsection
