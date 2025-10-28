@extends('layout.template')
@include('style.reportcss')

@section('title', 'Customizable Report')

@section('content')

    <h1 class="h1">📊 Advance Customizable Report</h1>

    <!-- Filters Form -->
    <form id="report-filter-form" method="GET" action="{{ route('reports.index') }}">
        <div class="filter-section">
            <!-- Role -->
            <div>
                <label for="role">Select Role:</label>
                <select id="role" name="role">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
                    <option value="staff" {{ request('role')=='staff'?'selected':'' }}>Staff</option>
                    <option value="user" {{ request('role')=='user'?'selected':'' }}>User</option>
                </select>
            </div>

            <!-- User -->
            <div>
                <label for="user_id">Select User:</label>
                <select id="user_id" name="user_id">
                    <option value="">All Users</option>
                    @foreach($allUsers as $user)
                        <option value="{{ $user->id }}" {{ request('user_id')==$user->id?'selected':'' }}>
                            {{ ucfirst($user->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category -->
            <div>
                <label for="category_id">Select Category:</label>
                <select id="category_id" name="category_id">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id')==$category->id?'selected':'' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <label for="status">Issue Status:</label>
                <select id="status" name="status">
                    <option value="">All</option>
                    <option value="Issued" {{ request('status')=='Issued'?'selected':'' }}>Issued</option>
                    <option value="Returned" {{ request('status')=='Returned'?'selected':'' }}>Returned</option>
                    <option value="Overdue" {{ request('status')=='Overdue'?'selected':'' }}>Overdue</option>
                </select>
            </div>

            <!-- ISBN -->
            <div>
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" value="{{ request('isbn') }}">
            </div>
            <div>
                <label for="author">Author:</label>
                <input type="text" name="author" value="{{ request('author') }}">
            </div>
            <div>
                <label for="issue_by">Issued By :</label>
                <select id="issue_by" name="issue_by">
                    <option value="">All</option>
                    @foreach($staffs as $staffMember)
                        <option value="{{ $staffMember->id }}" {{ request('issue_by')==$staffMember->id?'selected':'' }}>
                            {{ ucfirst($staffMember->name) }}({{ $staffMember->role }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Time Frame -->
            <div>
                <label for="time">Select Time Frame:</label>
                <select id="time" name="time">
                    <option value="all" {{ request('time')=='all'?'selected':'' }}>All Time</option>
                    <option value="today" {{ request('time')=='today'?'selected':'' }}>Today</option>
                    <option value="this_week" {{ request('time')=='this_week'?'selected':'' }}>This Week</option>
                    <option value="this_month" {{ request('time')=='this_month'?'selected':'' }}>This Month</option>
                    <option value="this_year" {{ request('time')=='this_year'?'selected':'' }}>This Year</option>
                    <option value="custom" {{ request('time')=='custom'?'selected':'' }}>Custom Range</option>
                </select>
            </div>

            <!-- Custom Date Range -->
            <div id="custom-date-range" style="{{ request('time')=='custom'?'display:flex':'display:none' }}">
                <label>From:</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}">
                <label>To:</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}">
            </div>
            <div>
                <label for="fine">Fine Amount:</label>
                <input type="text" name="fine" value="{{ request('fine') }}">
            </div>
        </div>

        <!-- Buttons -->
        <div style="margin-top:10px;">
            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reset</a>
            <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
            <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>
        </div>
    </form>

    <!-- Total Count -->
    <p id="total-count-wrapper">
        Total Count Fetch: <span id="total-count" style="color: white;">{{ $bookIssues->count() }}</span>
    </p>
    <!-- Report Table -->
    <div id="report-table" class="table-responsive" style="margin-top:20px;">
        <table class="table table-bordered" style="width:100%;">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>User Name</th>
                    <th>Role</th>
                    <th>Book Title</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Issued By</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Fine Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookIssues as $index => $item)
                    <tr>
                        <td>{{ $bookIssues->firstItem() + $index}}</td>
                        <td>{{ $item->user->name ?? '' }}</td>
                        <td>{{ $item->user->role ?? '' }}</td>
                        <td>{{ $item->book->title ?? '' }}</td>
                        <td>{{ $item->book->isbn ?? '' }}</td>
                        <td>{{ $item->book->author ?? '' }}</td>
                        <td>{{ $item->book->category->name ?? '' }}</td>
                        <td>{{ $item->issuedBy->name ?? 'NOT FOUND' }}</td>
                        <td>{{ $item->issue_date->format('Y-m-d') }}</td>
                        <td>{{ $item->return_date?? '  -' }}</td>
                        <td>₹{{ $item->fine_amount ?? '0' }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="11" class="text-center">No records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper" >
            {{ $bookIssues->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // Dark mode
    if(localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }

    // AJAX fetch
    function fetchReport() {
        let formData = $('#report-filter-form').serialize();
        $.ajax({
            url: "{{ route('reports.index') }}",
            type: "GET",
            data: formData,
            success: function(response) {
                let tbody = $(response).find('#report-table tbody').html();
                $('#report-table tbody').html(tbody);

                let total = $(response).find('#total-count').text();
                $('#total-count').text(total);
            }
        });
    }

        $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        $.ajax({
            url: url,
            type: "GET",
            data: $('#report-filter-form').serialize(),
            success: function(response) {
                let tbody = $(response).find('#report-table tbody').html();
                $('#report-table tbody').html(tbody);

                let total = $(response).find('#total-count').text();
                $('#total-count').text(total);

                let pagination = $(response).find('.pagination-wrapper').html();
                $('.pagination-wrapper').html(pagination);
            }
        });
    });
    // Filter changes
    $('#role').on('change', function() {
        let role = $(this).val();
        $.ajax({
            url: "{{ route('reports.usersByRole') }}",
            type: "GET",
            data: { role: role },
            success: function(users) {
                let userSelect = $('#user_id');
                userSelect.empty();
                userSelect.append('<option value="">All Users</option>');
                $.each(users, function(i, user) {
                    userSelect.append('<option value="'+user.id+'">'+user.name+'</option>');
                });
                fetchReport();
            }
        });
    });

    $('form select, form input').not('#role').on('change keyup', fetchReport);

    $('#time').on('change', function() {
        $('#custom-date-range').toggle(this.value === 'custom');
        fetchReport();
    });
});

// Dark mode toggle
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

</script>
@endsection
