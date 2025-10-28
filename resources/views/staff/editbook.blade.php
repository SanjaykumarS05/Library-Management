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
    <input type="text" id="title" name="title" value="{{$book->title}}">

    <label for="author">Author:</label>
    <input type="text" id="author" name="author" value="{{$book->author}}">

    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" value="{{$book->isbn}}" maxlength="13" pattern="\d{10}|\d{13}" title="Enter a 10 or 13 digit ISBN">

    <label for="category">Category:</label>
    <select id="category" name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <label for="publish_year">Published Year:</label>
    <input type="text" id="publish_year" name="publish_year" value="{{$book->publish_year}}" maxlength="4" pattern="\d{4}" title="Enter a valid year (e.g., 2000)">
    <label for="availability">Availability:</label>
    <select id="availability" name="availability" >
        <option value="Yes" {{ $book->availability == 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ $book->availability == 'No' ? 'selected' : '' }}>No</option>
    </select>

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" value="{{$book->stock}}"  min="0">


    <label for="image_path">Cover Image:</label>
    <input type="file" id="image_path" name="image_path">
    @if($book->image_path)
        <p>Current Image: <img src="{{ asset('storage/' . $book->image_path) }}" alt="Cover Image" width="100"></p>
    @endif

    <button type="submit" class="button1">Update Book</button>

</form>
@endsection