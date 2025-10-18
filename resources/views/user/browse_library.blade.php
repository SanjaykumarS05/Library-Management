@extends('layout.usertemplate')
@include('userstyle.browsecss')
@section('title', 'User Dashboard')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="dashboard-header">
        <h1>Welcome to the Library, {{ Auth::user()->name }}</h1>
        <p>Discover thousands of books, track your reading history, and request new titles.</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <span class="stat-icon">📚</span>
            <h2>{{ $totalBooks ?? 0 }}</h2>
            <p>Total Books</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">✅</span>
            <h2>{{ $availableBooks ?? 0 }}</h2>
            <p>Available Now</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">📖</span>
            <h2>{{ $userBooks ?? 0 }}</h2>
            <p>Your Books</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">💜</span>
            <h2>{{ $categoriesCount ?? 0 }}</h2>
            <p>Categories</p>
        </div>
    </div>

    <!-- Category Section -->
    <div class="category-section">
        <h3>Browse by Category</h3>
        <p>Explore our collection by topic</p>

        <div class="category-list">
            @foreach($categories as $category)
                <div class="category-item">{{ $category->name }} <span>({{ $category->books_count ?? 0 }})</span></div>
            @endforeach
        </div>

        <div class="toggle-buttons">
            <button class="active">Featured</button>
            <button>Popular</button>
            <button>All Books</button>
        </div>
    </div>

    <!-- Featured Books -->
    <h3>Featured Books</h3>
    <div class="book-grid">
        @foreach($books as $book)
        <div class="book-card">
            @if($book->is_borrowed)
                <span class="borrowed">Borrowed</span>
            @endif
            <img src="{{ asset('storage/' . $book->image_path) }}" alt="{{ $book->title }}" class="book-image">
            <div class="book-content">
                <div class="book-title">{{ $book->title }}</div>
                <div class="book-author">{{ $book->author }}</div>
                <div class="book-tags">
                    <span class="book-tag">{{ $book->category->name ?? 'General' }}</span>
                    <span class="book-tag">{{ $book->publish_year ?? '' }}</span>
                </div>
            </div>
            <div class="book-footer">
                <p>{{ $book->available_stock }} available</p>
                @if($book->is_issued)
                    <button class="borrow-btn" disabled>Currently Borrowed</button>
                @else
                    <button class="borrow-btn"><a href="{{ route('user.book.request', $book->id) }}">Request Book</a></button>
                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
