@extends('layout.template')
@section('title', 'Overall Issued Books')
@include('style.overallbookcss')

@section('content')

<h2 class="h2">Overall Issued Books</h2>

<div class="filter-bar" style="margin: 10px 0; display:flex; gap:10px; align-items:center;">
    <input type="text" id="search" placeholder="Search by Title, ISBN, Author, or Published year, Issued By ,Status " style="width:300px; padding:8px;">

    <select id="categoryFilter" style="padding:8px; width:200px;">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <button class="buttons" onclick="printContent('content-to-print')">🖨️ Print All</button>
    <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>

</div>
<div id="report-table">
<div id="content-to-print">
    @if($book_issues_count)
       <center><h3 class="h3">
            | Overall Books Issued: <span class="count">{{ $totalBooks }}</span> |
            Total Categories: <span class="count">{{ $categories->count() }}</span> |
            Current Issued Books: <span class="count">{{ $book_issues_count }}</span>
        </h3></center><br>

        <div class="barcode" id="barcode-cards">
            @include('admin.overallbooks_table', ['barcodes' => $barcodes])
        </div>
    @else
        <p>No issued books found.</p>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // 🧠 Reusable function for both search + category filter
    function fetchResults() {
        let query = $('#search').val();
        let category = $('#categoryFilter').val();

        $.ajax({
            url: "{{ route('staff.overallbooks.search') }}",
            type: 'GET',
            data: { search: query, category_id: category },
            success: function(response) {
                $('#barcode-cards').html(response);
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    }

    // Trigger AJAX when user types
    $('#search').on('keyup', function() {
        fetchResults();
    });

    // Trigger AJAX when category changes
    $('#categoryFilter').on('change', function() {
        fetchResults();
    });
});

</script>

@endsection
