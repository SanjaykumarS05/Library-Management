@extends('layout.template')
@section('title', 'Books Management')
@section('header')
    <h1>Manage Books</h1>
@endsection
@section('content')
<p> Book List</p>
<a href="{{ route('books.create') }}">Add Book</a>
<table border="1">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Category</th>
            <th>Published Year</th>
            <th>Availability</th>
            <th>Stock</th>
            <th>Cover Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->category->name }}</td>
            <td>{{ $book->publish_year }}</td>
            <td>{{ $book->availability }}</td>
            <td>{{ $book->stock }}</td>
            <td>
                @if($book->image_path)
                    <img src="{{ asset($book->image_path) }}" alt="Book Image" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                <form action="{{ route('books.delete', $book->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this book?');">Remove</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>   
</table>

@endsection
