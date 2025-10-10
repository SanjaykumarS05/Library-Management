@extends('layout.template')
@section('title', 'Search Books')
@include('style.searchcss')

@section('content')
<div class="container book-search">
    <h2>📚 Search Books</h2>

    <form method="GET" action="{{ route('search') }}" class="search-form">
        <div class="form-group">
            <input type="text" name="query" placeholder="Search by title, author, or ISBN" value="{{ request('query') }}">

            <select name="category">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option 
                        value="{{ $category->name }}" 
                        {{ request('category') == $category->name ? 'selected' : '' }}>{{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="availability">
                <option value="">All</option>
                <option value="Yes" {{ request('availability') == 'Yes' ? 'selected' : '' }}>Available</option>
                <option value="No" {{ request('availability') == 'No' ? 'selected' : '' }}>Unavailable</option>
            </select>
            <button type="submit">🔍 Search</button>
        </div>
    </form>

    <div class="book-results">
        @forelse($books as $book)
            <div class="book-card">
                <h4>Title: {{ $book->title }}</h4>
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Category:</strong> {{ $book->category->name ?? 'N/A' }}</p>
                <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                <p><strong>Published Year:</strong> {{ $book->publish_year }}</p>
                <p><strong>Stock:</strong> {{ $book->stock }}</p>
                <p><strong>Status:</strong> 
                    <span class="{{ $book->stock > 0 ? 'available' : 'unavailable' }}">
                        {{ $book->stock > 0 ? 'Available' : 'Unavailable' }}
                    </span>
                </p>

                @if($book->stock > 0)
                    <a href ="{{ route('books.issue_return1', $book->id) }}">📖 Issue Book</a>
                @endif
            </div>
        @empty
            <p>No books found.</p>
        @endforelse
    </div>
</div>
@endsection
