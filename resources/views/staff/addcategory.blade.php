@extends('layout.template')
@include('Style.addcss')
@section('title', 'Add Categories')

@section('content')
<h1>Add Categories</h1>
<form action="{{ route('staff.categories.store') }}"  class="form" method="POST">
    @csrf
    <div>
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>
    </div>
    <button type="submit" class="button1">Add Category</button>
    </div>
</form>
@endsection

