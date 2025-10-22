<div class="book-grid">
    @foreach($books as $book)
    <div class="book-card">
        @if($book->is_issued)
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
            @elseif($book->stock == 0)
            <button class="borrow-btn" disabled>❌ Book Unavailable</button>
            @else
                <button class="borrow-btn" onclick="window.location.href='{{ route('user.book.request', $book->id) }}'">
                Request Book
            </button>
            @endif
        </div>
    </div>
    @endforeach
    
    @if($books->isEmpty())
        <div class="no-books">
            <p>No books found matching your criteria.</p>
        </div>
    @endif
</div>