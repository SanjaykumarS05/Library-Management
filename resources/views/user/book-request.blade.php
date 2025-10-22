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

    @if(!empty($book))
    {{-- Request Form --}}
    <div class="request-form-section">
        <div class="card">
            <div class="card-header">
                <h3>Request a New Book</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.book.request.submit') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <label for="title">Book Title *</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ $book->title }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="author">Author *</label>
                            <input type="text" id="author" name="author" class="form-control" value="{{ $book->author }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="category">Category *</label>
                            <input type="text" id="category" name="category" class="form-control" value="{{ $book->category->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Comments">Comments (optional)</label>
                            <textarea id="Comments" name="Comments" class="form-control" rows="2" placeholder="Any additional information...">{{ old('Comments') }}</textarea>
                        </div>
                    </div>

                    <p class="terms-text">
                        <h3 class="h3" style ="font-size: 1.2em; margin-bottom: 10px;">Terms and Conditions:</h3>
                        <label>
                            <input type="checkbox" id="terms" name="terms">
                            After you receive a book from the library, you can keep it <b>free of charge for 15 days</b>. After that period, <b>a fine of ₹100 will be charged for each additional day</b>.
                        </label>
                    </p>

                    <button type="submit" class="btn btn-primary" style =" margin-top: 20px;">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
    @endif

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
                                <th>S.No</th>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($userRequests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="book-title">{{ $request->book->title }}</td>
                                <td>{{ $request->book->author }}</td>
                                <td>
                                    <span class="category-badge">{{ $request->book->category->name }}</span>
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
                                    {{ $request->Comments ?? '-' }}
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
                <div class="pagination-wrapper mt-4">
                {{ $userRequests->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection