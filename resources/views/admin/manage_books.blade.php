@extends('layout.template')
@section('title', 'Books Management')
@section('header')
    <h1>Manage Books</h1>
@endsection
@section('content')
<p> Book List</p>
<a href="{{ route('admin.books.create') }}">Add Book</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name }}</td>
            <td>
                <a href="{{ route('admin.books.edit', $book->id) }}">Edit</a>
                <form action="{{ route('admin.books.delete', $book->id) }}" method="POST" style="display:inline;">
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
