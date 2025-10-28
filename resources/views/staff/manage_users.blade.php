@extends('layout.template')
@section('title', 'Manage Users')
@include('style.managebookcss')

@section('content')
<h2 class="h2">Manage Users</h2>

<!-- Search & Filters -->
<form method="GET" class="search-form" id="user-search-form">
    <div class="form-group">
        <input type="text" id="search-name" name="search" 
               placeholder="Search by Name or Email"
               style="padding:5px; width:150%; position:relative; left:-92px;">
        <input type="text" id="search-fine" name="fine" 
               placeholder="Search by Fine Amount"
               style="padding:5px; width:10%; position:relative; left:-92px;">

        <select id="role" name="role" style="padding:5px; position:relative; left:-92px;">
            <option value="">All Roles</option>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
            <option value="user">User</option>
        </select>
    </div>
</form>

<a href="{{ route('staff.users.create') }}" class="addbook">╋ Add Member</a>
<a href="{{ route('staff.users') }}" class="btn btn-secondary">Reset</a>
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

    // ✅ Fetch Users (for search/filter/pagination)
    function fetchUsers(url = "{{ route('staff.users') }}") {
        let search = $('#search-name').val();
        let fine = $('#search-fine').val();
        let role = $('#role').val();

        $.ajax({
            url: url,
            type: 'GET',
            data: { search: search, fine: fine, role: role },
            success: function(response) {
                $('#report-table').html(response);
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    // ✅ Debounce typing (wait 300ms before fetching)
    let typingTimer;
    $('#search-name, #search-fine').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchUsers, 300);
    });

    // ✅ Role filter change
    $('#role').on('change', function() {
        fetchUsers();
    });

    // ✅ Handle pagination clicks (no full page reload)
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        fetchUsers(url);
    });

});
</script>
@endsection