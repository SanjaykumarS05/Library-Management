@extends('layout.template')
@section('title', 'Manage Categories')
@include('style.managebookcss')

@section('content')
<h2 class="h2">Manage Categories</h2>

<!-- Search Bar -->
<form method="GET" action="" class="search-form" id="category-search-form">
    <div class="form-group">
        <input type="text" id="search-description" placeholder="Search by Description"
               style="padding:5px; width:150%; position:relative; left:-92px;">

        <select id="search-name" style="padding:5px; position:relative; left:-92px;">
            <option value="">All Categories</option>
            @foreach($allCategories as $cat)
                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
</form>

<div style="margin-top:10px;">
    <a href="{{ route('categories.create') }}" class="addbook">╋ Add Category</a>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Reset</a>
    <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
    <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>
</div>

<!-- Categories Table -->
<div id="report-table">
    @include('admin.categories_table', ['categories' => $categories])
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // ✅ Fetch categories with optional URL (for pagination)
    function fetchCategories(url = "{{ route('categories.index') }}") {
        let name = $('#search-name').val();
        let description = $('#search-description').val();

        $.ajax({
            url: url,
            type: 'GET',
            data: { search_name: name, search_description: description },
            success: function(response) {
                $('#report-table').html(response);
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    // ✅ Trigger AJAX on input or select change
    $('#search-name, #search-description').on('change keyup', function() {
        fetchCategories();
    });

    // ✅ Handle pagination clicks (no full page reload)
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        fetchCategories(url);
    });

});
</script>
@endsection
