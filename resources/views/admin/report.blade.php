@extends('layout.template')

@section('title', 'Customizable Report')
@include('style.overallbookcss')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="container">
    <h1 class="h1">📊 Customizable Report</h1>

    <!-- Filter Form -->
    <form id="report-filter-form">
        <div class="filter-section">

            <!-- Role Filter -->
            <div>
                <label for="role">Select Role:</label>
                <select id="role" name="role">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="user">User</option>
                </select>
            </div>

            <!-- User Filter -->
            <div>
                <label for="user_id">Select User:</label>
                <select id="user_id" name="user_id">
                    <option value="">All Users</option>
                    @foreach($admin->merge($staff)->merge($users) as $user)
                        <option value="{{ $user->id }}">{{ ucfirst($user->name) }} ({{ $user->role }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <label for="category_id">Select Category:</label>
                <select id="category_id" name="category_id">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Book Availability -->
            <div>
                <label for="availability">Book Availability:</label>
                <select id="availability" name="availability">
                    <option value="">All</option>
                    <option value="Yes">Available</option>
                    <option value="No">Not Available</option>
                </select>
            </div>

            <!-- Issue Status -->
            <div>
                <label for="status">Issue Status:</label>
                <select id="status" name="status">
                    <option value="">All</option>
                    <option value="Issued">Issued</option>
                    <option value="Returned">Returned</option>
                </select>
            </div>

            <!-- ISBN -->
            <div>
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" placeholder="Enter ISBN">
            </div>

            <!-- Time Filter -->
            <div>
                <label for="time">Select Time Frame:</label>
                <select id="time" name="time" onchange="toggleCustomDate(this.value)">
                    <option value="all">All Time</option>
                    <option value="today">Today</option>
                    <option value="this_week">This Week</option>
                    <option value="this_month">This Month</option>
                    <option value="this_year">This Year</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>

            <!-- Custom Date Range -->
            <div id="custom-date-range" style="display:none;">
                <label for="from_date">From:</label>
                <input type="date" name="from_date" id="from_date">
                <label for="to_date">To:</label>
                <input type="date" name="to_date" id="to_date">
            </div>
        </div>
    </form>

    <!-- Report Table -->
    <div class="table-responsive" style="margin-top: 20px;">
        <table id="report-table" style="width:100%; border-collapse: collapse;" border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>User Name</th>
                    <th>Role</th>
                    <th>Book Title</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Published Year</th>
                    <th>Issued By</th>
                    <th>Issued To</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="report-body">
                <tr>
                    <td colspan="12" class="text-center">Loading data...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleCustomDate(value) {
    const rangeDiv = document.getElementById('custom-date-range');
    rangeDiv.style.display = value === 'custom' ? 'block' : 'none';
}

function fetchUsersByRole(role) {
    $.ajax({
        url: "{{ route('reports.usersByRole') }}",
        type: "GET",
        data: { role: role },
        success: function(users) {
            let userSelect = $('#user_id');
            userSelect.empty();
            userSelect.append('<option value="">All Users</option>');
            users.forEach(function(user) {
                userSelect.append(`<option value="${user.id}">${user.name}</option>`);
            });
        },
        error: function() {
            alert('Failed to fetch users.');
        }
    });
}

$(document).ready(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // Fetch all data initially
    fetchReport();

    // Update User dropdown when Role changes
    $('#role').on('change', function() {
        fetchUsersByRole($(this).val());
        fetchReport();
    });

    // Apply other filters dynamically
    $('#report-filter-form select, #report-filter-form input').not('#role').on('change keyup', function() {
        fetchReport();
    });

    function fetchReport() {
        let formData = $('#report-filter-form').serialize();

        $.ajax({
            url: "{{ route('reports.fetch') }}",
            method: "GET",
            data: formData,
            beforeSend: function() {
                $('#report-body').html('<tr><td colspan="12">Loading...</td></tr>');
            },
            success: function(data) {
                let html = '';
                if(data.length > 0){
                    $.each(data, function(index, issue){
                        html += '<tr>';
                        html += '<td>' + (index+1) + '</td>';
                        html += '<td>' + (issue.user_name ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.user_role ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.book_title ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.book_isbn ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.book_author ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.category ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.publish_year ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.issued_by ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.issued_to ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.issue_date ?? 'UNKNOWN') + '</td>';
                        html += '<td>' + (issue.status ?? 'UNKNOWN') + '</td>';
                        html += '</tr>';
                    });
                } else {
                    html = '<tr><td colspan="12" class="text-center">No records found.</td></tr>';
                }
                $('#report-body').html(html);
            },
            error: function(err){
                console.log(err);
                $('#report-body').html('<tr><td colspan="12">Error fetching data</td></tr>');
            }
        });
    }
});
</script>
@endsection
