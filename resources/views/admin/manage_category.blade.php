@extends('layout.template')
@section('title', 'Manage Categories')
@section('header')
    <h1>Manage Categories</h1>
@endsection
@section('content')
<p> Category List</p>
<a href="{{ route('categories.create') }}">Add Category</a>
<table border="1">
    <thead>
        <tr>
            <th>Categories</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                <form action="{{ route('categories.delete', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?');">Remove</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

        