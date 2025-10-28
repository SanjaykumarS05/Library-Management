<table border="1">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Category</th>
            <th>Published Year</th>
            <th>Availability</th>
            <th>Total Copies</th>
            <th>In Stock</th>
            <th class="no-export">Cover Image</th>
            <th class="no-export">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books as $index => $book)
        <tr>
            <td>{{ $books->firstItem() + $index }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->category->name ?? '-' }}</td>
            <td>{{ $book->publish_year }}</td>
            <td class="{{ $book->availability == 'Yes' ? 'Available' : 'Unavailable' }}">{{ $book->availability }}</td>
            <td>{{ $book->issued_count + $book->stock }}</td>
            <td>{{ $book->stock }}</td>
            <td class="no-export">
                @if($book->image_path)
                    <img src="{{ asset('storage/' . $book->image_path) }}" alt="Book Image" width="100">
                @endif
            </td>
            <td class="no-export">
                <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                <form action="{{ route('books.delete', $book->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button1" onclick="return confirm('Are you sure you want to delete this book?');">Remove</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="11" class="text-center">No books found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="no-export">
<div class="pagination-wrapper">
            {{ $books->links('pagination::bootstrap-5') }}
</div>
</div>