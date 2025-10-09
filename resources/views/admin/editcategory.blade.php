@extends('layout.template')
@section('title', 'Edit Category')
@section('header')
    <h1>Edit Category</h1>
@endsection

@section('content')

 <form action="{{ route('categories.update', $category->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" value="{{ $category->name }}" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ $category->description }}</textarea>
        <button type="submit">Update</button>
    </form>

@endsection

