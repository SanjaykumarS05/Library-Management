@extends('layout.template')
@section('title', 'Add Books')
@section('header')
    <h1>Add Books</h1>
@endsection

@section('content')

<form action="{{ route('admin.books.add') }}" method="POST">
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
        <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}" required>
    </div>

    <div>
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="publisher_year">Publisher:</label>
        <input type="text" id="publisher_year" name="publisher_year" value="{{ old('publisher_year') }}" required>
    </div>
    
    <div>
        <label for="availability">Availability:</label>
        <input type="number" id="availability" name="availability" value="{{ old('availability') }}" required>
    </div>
    

    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>
    </div>

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
</body>
</html>

