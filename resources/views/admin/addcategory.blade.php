@extends('layout.template')
@include('Style.admincss')
@section('title', 'Add Categories')
@section('header')
    <h1>Add Categories</h1>
@endsection

@section('content')

<form action="{{ route('categories.store') }}"  class="form" method="POST">
    @csrf
    <div>
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
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
@endsection

