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
                <h2 class="text-danger">{{ $overdue }}</h2>
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
    <h4 class="mb-3">Active Loans</h4>
    <div class="row">
        @foreach($bookIssues->where('status', 'Active') as $issue)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border {{ \Carbon\Carbon::parse($issue->due_date)->isPast() ? 'border-danger' : 'border-success' }}">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $issue->book->title ?? 'Unknown Book' }}</h5>
                    <p class="text-muted">{{ $issue->book->author ?? 'Unknown Author' }}</p>
                    <p>📅 Borrowed: {{ \Carbon\Carbon::parse($issue->borrowed_date)->format('M d, Y') }}</p>
                    <p>📆 Due: {{ \Carbon\Carbon::parse($issue->due_date)->format('M d, Y') }}</p>

                    @if(\Carbon\Carbon::parse($issue->due_date)->isPast())
                        <span class="badge bg-danger">Overdue by {{ \Carbon\Carbon::parse($issue->due_date)->diffInDays(now()) }} days</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Complete History --}}
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-white">
            <h5 class="fw-bold mb-0">Complete History</h5>
        </div>
        <div class="card-body">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Book</th>
                        <th>Author</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookIssues as $issue)
                    <tr>
                        <td>{{ $issue->book->title ?? 'Unknown' }}</td>
                        <td>{{ $issue->book->author ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($issue->borrowed_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($issue->due_date)->format('M d, Y') }}</td>
                        <td>
                            {{ $issue->return_date ? \Carbon\Carbon::parse($issue->return_date)->format('M d, Y') : '-' }}
                        </td>
                        <td> {{ $issue->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
