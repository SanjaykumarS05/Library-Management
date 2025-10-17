@extends('layout.usertemplate')
@section('title', 'Book Requests')
@include('userstyle.bookrequestcss')
@section('content')
<div class="book-requests-container">
    <div class="header-section">
        <h1 class="page-title">Book Requests</h1>
        <p class="page-subtitle">Request new books for the library collection</p>
    </div>

    {{-- Stats Section --}}
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-content">
                <h3 class="stat-number">2</h3>
                <p class="stat-label">Reading</p>
            </div>
        </div>
        <div class="stat-card approved">
            <div class="stat-icon">✅</div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['approved'] }}</h3>
                <p class="stat-label">Approved</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['pending'] }}</h3>
                <p class="stat-label">Pending</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total'] }}</h3>
                <p class="stat-label">Total Requests</p>
            </div>
        </div>
    </div>

    {{-- Request Form --}}
    <div class="request-form-section">
        <div class="card">
            <div class="card-header">
                <h3>Request a New Book</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('book-requests.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title">Book Title *</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author *</label>
                            <input type="text" id="author" name="author" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="category">Category *</label>
                            <select id="category" name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Self-help">Self-help</option>
                                <option value="Psychology">Psychology</option>
                                <option value="Fiction">Fiction</option>
                                <option value="Non-fiction">Non-fiction</option>
                                <option value="Business">Business</option>
                                <option value="Science">Science</option>
                                <option value="History">History</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comments">Comments (Optional)</label>
                            <textarea id="comments" name="comments" class="form-control" rows="2" placeholder="Any additional information..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Your Requests Table --}}
    <div class="requests-table-section">
        <div class="section-header">
            <h2>Your Requests</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="requests-table">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($userRequests as $request)
                            <tr>
                                <td class="book-title">{{ $request->title }}</td>
                                <td>{{ $request->author }}</td>
                                <td>
                                    <span class="category-badge">{{ $request->category }}</span>
                                </td>
                                <td class="request-date">
                                    <span class="date-icon">📅</span>
                                    {{ \Carbon\Carbon::parse($request->request_date)->format('M d, Y') }}
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $request->status }}">
                                        @if($request->status === 'approved')
                                            Approved
                                        @elseif($request->status === 'rejected')
                                            Rejected
                                        @else
                                            Pending
                                        @endif
                                    </span>
                                </td>
                                <td class="notes-cell">
                                    {{ $request->notes ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center no-requests">
                                    <p>No book requests yet. Submit your first request above!</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection