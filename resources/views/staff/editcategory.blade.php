@extends('layout.template')
@section('title', 'Edit Category')
@include('style.editcss')

@section('content')
<h1 class="h1">Edit Category</h1>

 <form action="{{ route('staff.categories.update', $category->id) }}" method="post" class="form">
        @csrf
        @method('PUT')
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" value="{{ $category->name }}">

        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ $category->description }}</textarea>
        <button type="submit" class="button1">Update</button>
    </form>

@endsection

