@extends('layout.usertemplate')

@section('title', 'User Dashboard')
@include('Style.admincss')

@section('content')

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h2>Library Dashboard</h2>
            <p>Overview of library statistics and activities</p>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Books</h3>
                <p>{{ $totalBooks + $issuedBooks }}</p>
                <p class="sub">Across {{ $categoriesCount }} categories</p>
            </div>
            <div class="stat-card">
                <h3>Available Books</h3>
                <p>{{ $totalBooks }}</p>
                <p class="sub">Books currently in stock</p>
            </div>
            <div class="stat-card">
                <h3>Books Count</h3>
                <p>{{ $booksCount }}</p>
                <p class="sub">Books in the Library</p>
            </div>
            <div class="stat-card">
                <h3>Out of Stock Books</h3>
                <p>{{ $outOfStockBooks }}</p>
                <p class="sub">Need restocking</p>
            </div>
        </div>

        <div class="utilisation">
            <h3>Library Utilisation</h3>
            <p>Books Currently Issued: <strong>{{ $issuedPercentage }}%</strong></p>
        </div>
    

        <div class="low-stock">
            <h3>Low Stock Alert</h3>
            @if($lowStockBooks->isEmpty())
                <p>All books are sufficiently stocked.</p>
            @else
                <ul>
                    @foreach($lowStockBooks as $book)
                        <li><strong>{{ $book->title }}</strong> by {{ $book->author }} — <span>{{ $book->stock }} left</span></li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- <div class="dashboard-stats">
            <div class="stat-card">
                <h3>{{ $totalIssued }}</h3>
                <p>Total Books Issued</p>
            </div>
            <div class="stat-card">
                <h3>{{ $returnedCount }}</h3>
                <p>Books Returned</p>
            </div>
            <div class="stat-card">
                <h3>{{ $pendingCount }}</h3>
                <p>Currently Issued</p>
            </div>
        </div> -->

        <!-- 📚 Recent Activities -->
        <div class="recent-activity">
            <h3>📖 Your Recent Activities</h3>
            @if($recentBooks->count())
                <ul>
                    @foreach($recentBooks as $book)
                        <li>
                            <strong>{{ ucfirst($book->status) }}:</strong>
                            <span>{{ $book->book->title ?? 'N/A' }} by {{ $book->book->author ?? '-' }}  ({{$book->time_ago}}) </span>
                            
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="no-books">You haven’t issued any books yet.</p>
            @endif
        </div>
        </div>
@endsection
