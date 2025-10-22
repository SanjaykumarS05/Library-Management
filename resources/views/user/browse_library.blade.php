@extends('layout.usertemplate')
@include('userstyle.browsecss')
@section('title', 'User Dashboard')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="dashboard-header">
        <h1>Welcome to the Library, {{ Auth::user()->name }}</h1>
        <p>Discover thousands of books, track your reading history, and request new titles.</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <span class="stat-icon">📚</span>
            <h2>{{ $totalBooks }}</h2>
            <p>Total Books</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">✅</span>
            <h2>{{ $availableBooks }}</h2>
            <p>Available Now</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">📖</span>
            <h2>{{ $userBooks }}</h2>
            <p>Your Books</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">💜</span>
            <h2>{{ $categoriesCount }}</h2>
            <p>Categories</p>
        </div>
    </div>

    <!-- Category Section -->
    <div class="category-section">
        <h3>Browse by Category</h3>
        <p>Explore our collection by topic</p>

        <div class="category-list">
            <div class="category-item active" data-category="">All Categories <span>({{ $totalBooks }})</span></div>
            @foreach($categories as $category)
                <div class="category-item" data-category="{{ $category->name }}">
                    {{ $category->name }} <span>({{ $category->books_count }})</span>
                </div>
            @endforeach
        </div>

        <div class="toggle-buttons">
            <button class="filter-btn {{ $filterType === 'featured' ? 'active' : '' }}" data-filter="featured">Featured</button>
            <button class="filter-btn {{ $filterType === 'popular' ? 'active' : '' }}" data-filter="popular">Popular</button>
            <button class="filter-btn {{ $filterType === 'all' ? 'active' : '' }}" data-filter="all">All Books</button>
        </div>
    </div>

    <!-- Books Section -->
    <h3 id="books-section-title">
        @if($filterType === 'featured')
            Featured Books
        @elseif($filterType === 'popular')
            Popular Books
        @else
            All Books
        @endif
    </h3>
    
    <div id="books-container">
        @include('user.partials.book_grid')
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentFilter = '{{ $filterType }}';
    let currentCategory = '';
    let currentSearch = '';

    function updateSectionTitle() {
        const titleElement = document.getElementById('books-section-title');
        let title = '';

        switch(currentFilter) {
            case 'featured': title = 'Featured Books'; break;
            case 'popular': title = 'Popular Books'; break;
            case 'all': title = 'All Books'; break;
        }

        if (currentCategory) title += ` in ${currentCategory}`;
        if (currentSearch) title += ` matching "${currentSearch}"`;

        titleElement.textContent = title;
    }

    function loadBooks() {
        document.getElementById('books-container').innerHTML = '<div class="loading">Loading books...</div>';
        updateSectionTitle();

        fetch('{{ route("user.browse.filter") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                filter: currentFilter,
                category: currentCategory,
                search: currentSearch
            })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('books-container').innerHTML = data.html;
        })
        .catch(() => {
            document.getElementById('books-container').innerHTML = '<div class="error">Error loading books. Please try again.</div>';
        });
    }

    document.querySelectorAll('.category-item').forEach(item => {
        item.addEventListener('click', function() {
            currentCategory = this.dataset.category;
            document.querySelectorAll('.category-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            loadBooks();
        });
    });

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentFilter = this.dataset.filter;
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            loadBooks();
        });
    });
});
</script>
@endsection
