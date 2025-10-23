@forelse($books as $book)
<div class="book-card">
    <h4>{{ $book->title }}</h4>
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>Category:</strong> {{ $book->category->name ?? 'N/A' }}</p>
    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
    <p><strong>Published:</strong> {{ $book->publish_year }}</p>
    <p><strong>Stock:</strong> {{ $book->stock }}</p>
    <p><strong>Status:</strong> 
        <span class="{{ $book->stock > 0 ? 'available' : 'unavailable' }}">
            {{ $book->stock > 0 ? 'Available' : 'Unavailable' }}
        </span>
    </p>

    @if(!$book->can_request)
        <button class="borrow-btn" disabled> {{ $book->request_message }}</button>
    @elseif($book->stock == 0)
        <button class="borrow-btn" disabled>❌ Book Unavailable</button>
    @else
        <button class="borrow-btn" onclick="window.location.href='{{ route('user.book.request', $book->id) }}'">
            📖 Request Book
        </button>
    @endif
</div>
@empty
<p>No books found matching your criteria.</p>
@endforelse

