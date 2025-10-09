@extends('layout.template')
@include('style.admincss')

@section('title', 'Admin Dashboard')

@section('content')
<div class="dashboard-container">

    <div class="dashboard-header">
        <h2>Library Dashboard</h2>
        <p>Overview of library statistics and activities</p>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Books</h3>
            <p>{{ $totalBooks }}</p>
            <p class="sub">Across {{ $categoriesCount }} categories</p>
        </div>

        <div class="stat-card">
            <h3>Available Books</h3>
            <p>{{ $availableBooks }}</p>
            <p class="sub">Books currently in stock</p>
        </div>

        <div class="stat-card">
            <h3>Out of Stock Books</h3>
            <p>{{ $outOfStockBooks }}</p>
            <p class="sub">Need restocking</p>
        </div>

        <div class="stat-card">
            <h3>Active Staff</h3>
            <p>{{ $activeStaff }}</p>
            <p class="sub">Managing library operations</p>
        </div>

        <div class="stat-card">
            <h3>Active Users</h3>
            <p>{{ $activeUsers }}</p>
            <p class="sub">Registered library members</p>
        </div>
    </div>

    <div class="utilisation">
        <h3>Library Utilisation</h3>
        <p>Books Out of Stock: <strong>{{ $issuedPercentage }}%</strong></p>
    </div>

    <div class="low-stock">
        <h3>Low Stock Alert</h3>
        @if($lowStockBooks->isEmpty())
            <p>All books are sufficiently stocked.</p>
        @else
            <ul>
                @foreach($lowStockBooks as $book)
                    <li>
                        <strong>{{ $book->title }}</strong> by {{ $book->author }} — 
                        <span>{{ $book->stock }} left</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="recent-activity">
        <h3>Recent Activity</h3>
        @if($recentActivities->isEmpty())
            <p>No recent book issue/return activity.</p>
        @else
            <ul>
                @foreach($recentActivities as $activity)
                    <li>
                        <strong>{{ $activity->type }}</strong>: 
                        {{ $activity->book_title }} by {{ $activity->user_name }} 
                        <span>({{ $activity->time_ago }})</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
