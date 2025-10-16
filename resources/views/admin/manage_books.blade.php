@extends('layout.template')
@section('title', 'Books Management')
@include('style.managebookcss')

@section('content')
<h2 class="h2">Manage Books</h2>

<!-- Search & Filters -->
<form method="GET" action="" class="search-form" id="book-search-form">
<div class="form-group">
    <input type="text" id="search" placeholder="Search by Title, Author, ISBN" style="padding:5px;">
    <select id="category" style="padding:5px;">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <select id="availability" style="padding:5px;">
        <option value="">All Availability</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
</div>
</form>
    <a href="{{ route('books.create') }}" class="addbook">╋ Add Book</a>
    <a href="{{ route('books') }}" class="btn btn-secondary">Reset</a>
    <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
    <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>



<!-- Table -->
<div id="report-table">
    @include('admin.books_table', ['books' => $books])
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    function fetchBooks() {
        let query = $('#search').val();
        let category = $('#category').val();
        let availability = $('#availability').val();

        $.ajax({
            url: "{{ route('books') }}",
            type: 'GET',
            data: { search: query, category: category, availability: availability },
            success: function(response) {
                $('#report-table').html(response);
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    // Trigger AJAX on search input or filter change
    $('#search, #category, #availability').on('keyup change', fetchBooks);
});
</script>
@endsection
