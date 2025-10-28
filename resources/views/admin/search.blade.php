@extends('layout.template')
@section('title', 'Search Books')
@include('style.searchcss')

@section('content')
   <center> <h2 class="h2">📚 Search Books</h2>
    </center><br>
    <!-- Search Form -->
    <form method="GET" action="" class="search-form" id="book-search-form">
        <div class="form-group">
            <input type="text" name="query" id="search-query" 
                placeholder="Search by title, author, Published Year, or ISBN" 
                value="{{ request('query') }}">

            <select name="category" id="search-category">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->name }}" 
                        {{ request('category') == $category->name ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="availability" id="search-availability">
                <option value="">All</option>
                <option value="Yes" {{ request('availability') == 'Yes' ? 'selected' : '' }}>Available</option>
                <option value="No" {{ request('availability') == 'No' ? 'selected' : '' }}>Unavailable</option>
            </select>
             <a href="{{ route('search') }}" class="btn btn-secondary">Reset</a>
        </div>
       
    </form>

    <!-- Search Results -->
    <div id="book-results">
        @include('admin.search_results', ['books' => $books])
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // ✅ Fetch books with optional page URL
    function fetchBooks(url = "{{ route('search') }}") {
        var query = $('#search-query').val();
        var category = $('#search-category').val();
        var availability = $('#search-availability').val();

        $.ajax({
            url: url,
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

    // ⏳ Add delay for typing
    let typingTimer;
    const typingDelay = 500;

    $('#search-query').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchBooks, typingDelay);
    });

    $('#search-category, #search-availability').on('change', function() {
        fetchBooks();
    });

    // ✅ Handle pagination clicks dynamically
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        fetchBooks(url);
    });

});
</script>
@endsection
