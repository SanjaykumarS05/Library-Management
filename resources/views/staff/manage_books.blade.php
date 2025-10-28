@extends('layout.template')
@section('title', 'Books Management')
@include('style.managebookcss')

@section('content')
<h2 class="h2">Manage Books</h2>

<!-- Search & Filters -->
<form method="GET" class="search-form" id="book-search-form">
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
    <a href="{{ route('staff.books.create') }}" class="addbook">╋ Add Book</a>
    <a href="{{ route('staff.books') }}" class="btn btn-secondary">Reset</a>
    <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
    <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>



<!-- Table -->
<div id="report-table">
    @include('staff.books_table', ['books' => $books])
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // ✅ Fetch books via AJAX (used for search/filter/pagination)
    function fetchBooks(url = "{{ route('staff.books') }}") {
        let query = $('#search').val();
        let category = $('#category').val();
        let availability = $('#availability').val();

        $.ajax({
            url: url,
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

    // ✅ Trigger on search/filter
    $('#search, #category, #availability').on('keyup change', function() {
        fetchBooks();
    });

    // ✅ Handle pagination clicks (inside ready)
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        fetchBooks(url);
    });

});
</script>
@endsection
