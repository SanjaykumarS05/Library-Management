@extends('layout.usertemplate')
@section('title', 'Search Books')
@include('style.searchcss')

@section('content')
<div class="container book-search">
    <h2 class="h2">📚 Search Books</h2>
    <form method="GET" action="{{ route('user.search') }}" class="search-form" id="book-search-form">
        <div class="form-group">
            <input type="text" name="query" id="search-query" placeholder="Search by title, author, Published Year ,or ISBN" value="{{ request('query') }}">

            <select name="category" id="search-category">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option 
                        value="{{ $category->name }}" 
                        {{ request('category') == $category->name ? 'selected' : '' }}>{{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="availability" id="search-availability">
                <option value="">All</option>
                <option value="Yes" {{ request('availability') == 'Yes' ? 'selected' : '' }}>Available</option>
                <option value="No" {{ request('availability') == 'No' ? 'selected' : '' }}>Unavailable</option>
            </select>
        </div>
    </form>
    <div class="book-results" id="book-results">
        @include('user.partials.search_results', ['books' => $books])
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    function fetchBooks() {
        var query = $('#search-query').val();
        var category = $('#search-category').val();
        var availability = $('#search-availability').val();

        $.ajax({
            url: "{{ route('user.search') }}",
            method: "GET",
            data: { query: query, category: category, availability: availability },
            success: function(response) {
                $('#book-results').html(response);
            },
            error: function() {
                toastr.error('Error fetching books');
            }
        });
    }

    let typingTimer;
    const typingDelay = 500;

    $('#search-query').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchBooks, typingDelay);
    });

    $('#search-category, #search-availability').on('change', function() {
        fetchBooks();
    });
});
</script>
@endsection
