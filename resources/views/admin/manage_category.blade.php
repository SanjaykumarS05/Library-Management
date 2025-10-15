@extends('layout.template')
@section('title', 'Manage Categories')
@include('style.managebookcss')

@section('content')
<h2 class="h2">Manage Categories</h2>

<!-- Search Bar -->
<div class="search-bar" style="margin:10px 0;">
    <input type="text" id="search" placeholder="Search by Category or Description" style="width:300px; padding:5px;">
</div>

<a href="{{ route('categories.create') }}" class="addbook">╋ Add Category</a>

<div style="margin-top:10px;">
            <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
            <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>
        </div>
<br>
<!-- Categories Table -->
<div id="report-table">
<div id="categories-table">
    <table border="1">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Categories</th>
                <th>Description</th>
                <th class="no-export">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td class="no-export">
                    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                    <form action="{{ route('categories.delete', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button1" onclick="return confirm('Are you sure you want to delete this category?');">Remove</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#search').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('categories.index') }}",
            type: 'GET',
            data: { search: query },
            success: function(response) {
                $('#categories-table').html(response);
            }
        });
    });
});
</script>
@endsection
