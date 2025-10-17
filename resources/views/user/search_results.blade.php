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
            <a href ="{{ route('staff.books.issue_return1', $book->id) }}">📖 Request Book</a>
        @endif
    </div>
@empty
    <p>No books found.</p>
@endforelse
