@extends('layout.template')
@section('title', 'Edit Books')
@include('style.editcss')
@section('content')
<h1 class="h1">Edit Books</h1>
<p class="p"> Current Book Details</p>
<form action="{{route('staff.books.update', $book->id)}}" method="post" class="form" enctype="multipart/form-data">
    @csrf
    
    @method('PUT')
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="{{$book->title}}" required>

    <label for="author">Author:</label>
    <input type="text" id="author" name="author" value="{{$book->author}}" required>

    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" value="{{$book->isbn}}" maxlength="13" pattern="\d{10}|\d{13}" title="Enter a 10 or 13 digit ISBN" required>

    <label for="category">Category:</label>
    <select id="category" name="category_id" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <label for="publish_year">Published Year:</label>
    <input type="text" id="publish_year" name="publish_year" value="{{$book->publish_year}}" maxlength="4" pattern="\d{4}" title="Enter a valid year (e.g., 2000)" required>

    <label for="availability">Availability:</label>
    <select id="availability" name="availability" required>
        <option value="Yes" {{ $book->availability == 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ $book->availability == 'No' ? 'selected' : '' }}>No</option>
    </select>
    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" value="{{$book->stock}}" required min="0">
    

    <label for="cover_image">Cover Image:</label>
    <input type="file" id="cover_image" name="cover_image">
    @if($book->cover_image)
        <p>Current Image: <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image" width="100"></p>
    @endif

    <button type="submit" class="button1">Update Book</button>

</form>
@endsection