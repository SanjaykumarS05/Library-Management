@extends('layout.template')
@include('Style.admincss')
@section('title', 'Add Books')
@section('header')
    <h1>Add Books</h1>
@endsection

@section('content')

<form action="{{ route('books.add') }}" method="POST">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
    </div>
    <div>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="{{ old('author') }}" required>
    </div>
    <div>
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}" maxlength="13" pattern="\d{10}|\d{13}" title="Enter a 10 or 13 digit ISBN" required>

    </div>

    <div>
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="" disabled selected>Select category</option>
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="publish_year">Published Year:</label>
        <input type="text" id="publish_year" name="publish_year" value="{{ old('publish_year') }}" required maxlength="4" pattern="\d{4}" title="Enter a valid year (e.g., 2000)">
    </div>
    
    <input type="hidden" id="availability" name="availability" value="Yes">

    <div>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required min="0">
    </div>
    <form action="{{ route('books.add') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="image_path">Image:</label>
        <input type="file" id="image_path" name="image_path" accept="image/*">
    </div>
    </form>

    <button type="submit">Add Book</button>
    </div>
    <script>
           @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>
@endsection

