@extends('layout.usertemplate')
@include('userstyle.historycss')
@section('title', 'Borrowing History')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-3">Borrowing History</h2>
    <p class="text-muted mb-4">Track all your borrowed books and returns</p>

    {{-- Summary Cards --}}
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-3 text-center">
                <h5>Currently Borrowed</h5>
                <h2>{{ $currentlyBorrowed }}</h2>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-3 text-center">
                <h5>Overdue</h5>
                <h2 class="text-danger">{{ $overalldue }}</h2>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-3 text-center">
                <h5>Returned</h5>
                <h2 class="text-success">{{ $returned }}</h2>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-3 text-center">
                <h5>Total History</h5>
                <h2>{{ $totalHistory }}</h2>
            </div>
        </div>
    </div>

    {{-- Active Loans --}}
    @if($bookIssues->whereIn('status', ['Issued', 'Overdue'])->count() > 0)
    <h4 class="mb-3">Active Loans</h4>
    <div class="row">
        @foreach($bookIssues->whereIn('status', ['Issued', 'Overdue']) as $issue)
            @php
                $issueDate = \Carbon\Carbon::parse($issue->issue_date);
                $dueDate = $issueDate->copy()->addDays(15);
                $today = now();
                $overdueDays = $today->greaterThan($dueDate) ? $dueDate->diffInDays($today) : 0;
            @endphp
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border {{ $overdueDays > 0 ? 'border-danger' : 'border-success' }}">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $issue->book->title ?? 'Unknown Book' }}</h5>
                        <p class="text-muted">{{ $issue->book->author ?? 'Unknown Author' }}</p>
                        <p>📅 Borrowed: {{ $issueDate->format('M d, Y') }}</p>
                        <p>📆 Due: {{ $dueDate->format('M d, Y') }}</p>
                        @if($overdueDays > 0)
                        <p>💰 Fine Amount: ₹{{ $overdueDays * 10 }}.00</p>
                        <br>
                        <span class="badge bg-danger">Overdue by {{ $overdueDays }} days</span>  
                        @else
                            <span class="badge bg-success">On Time</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
     <div style="margin-top:10px; margin-bottom:20px;">
            <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
            <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>
        </div>
    {{-- Complete History --}}
    <div class="card shadow-sm mt-4" div id="report-table">
        <div class="card-body" >
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Book</th>
                            <th>Author</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Return Date</th>
                            <th>Fine Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookIssues as $index => $issue)
                            @php
                                $issueDate = \Carbon\Carbon::parse($issue->issue_date);
                                $dueDate = $issueDate->copy()->addDays(15);
                            @endphp
                            <tr>
                                <td>{{ $bookIssues->firstItem() + $index }}</td>
                                <td>{{ $issue->book->title ?? 'Unknown' }}</td>
                                <td>{{ $issue->book->author ?? '-' }}</td>
                                <td>{{ $issueDate->format('M d, Y') }}</td>
                                <td>{{ $dueDate->format('M d, Y') }}</td>
                                <td>{{ $issue->return_date ? \Carbon\Carbon::parse($issue->return_date)->format('M d, Y') : '-' }}</td>
                                <td>{{ $issue->fine_amount ? '₹' . number_format($issue->fine_amount, 2) : '-' }}</td>
                                <td>
                                    @if ($issue->status == 'Returned')
                                        <span class="badge bg-success">Returned</span>
                                    @elseif ($issue->status == 'Overdue')
                                        <span class="badge bg-danger">Overdue</span>
                                    @elseif ($issue->status == 'Issued')
                                        <span class="badge bg-primary">Currently Borrowed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $issue->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No borrowing history found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="no-export">
            @if($bookIssues->hasPages())
                <div class="pagination-wrapper mt-4">
                    {{ $bookIssues->links('pagination::bootstrap-5') }}
                </div>
            @endif
</div>
        </div>
    </div>
</div>
@endsection
