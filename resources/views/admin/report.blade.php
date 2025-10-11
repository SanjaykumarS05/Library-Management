@extends('layout.template')

@section('title', 'Customizable Report')
@include('style.overallbookcss')

@section('content')
<div class="container">

    <h1 class="h1">📊 Customizable Report</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('reports.index') }}">
        <div class="filter-section">
            <!-- Role Filter -->
           <div>
                <label for="role">Select Role:</label>
                <select id="role" name="role" onchange="fetchUsersByRole(this.value)">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <!-- User Filter -->
            <div>
                <label for="user_id">Select User:</label>
                <select id="user_id" name="user_id">
                    <option value="">All Users</option>
                    @foreach($admin->merge($staff)->merge($users) as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ ucfirst($user->name) }} ({{ $user->role }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Time Filter -->
            <div>
                <label for="time">Select Time Frame:</label>
                <select id="time" name="time" onchange="toggleCustomDate(this.value)">
                    <option value="all" {{ request('time') == 'all' ? 'selected' : '' }}>All Time</option>
                    <option value="today" {{ request('time') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="this_week" {{ request('time') == 'this_week' ? 'selected' : '' }}>This Week</option>
                    <option value="this_month" {{ request('time') == 'this_month' ? 'selected' : '' }}>This Month</option>
                    <option value="this_year" {{ request('time') == 'this_year' ? 'selected' : '' }}>This Year</option>
                    <option value="custom" {{ request('time') == 'custom' ? 'selected' : '' }}>Custom Range</option>
                </select>
            </div>

            <!-- Custom Date Range -->
            <div id="custom-date-range" style="display: {{ request('time') == 'custom' ? 'block' : 'none' }};">
                <label for="from_date">From:</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}">
                <label for="to_date">To:</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}">
            </div>

            <button type="submit" class="button1">Generate Report</button>
        </div>
    </form>

    <!-- Report Table -->
    <div class="table-responsive" style="margin-top: 20px;">
        <table class="table table-bordered" id="report-table">
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
            <tbody>
                @forelse($book_issues as $issue)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $issue->user->name ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->user->role ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->book->title ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->book->isbn ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->book->author ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->book->category->name ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->book->publish_year ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->issuedUser->name ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->user->name ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->issue_date ?? 'UNKNOWN' }}</td>
                        <td>{{ $issue->status ?? 'UNKNOWN' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
// Show/hide custom date range fields dynamically
function toggleCustomDate(value) {
    const rangeDiv = document.getElementById('custom-date-range');
    rangeDiv.style.display = value === 'custom' ? 'block' : 'none';
}
</script>
@endsection
