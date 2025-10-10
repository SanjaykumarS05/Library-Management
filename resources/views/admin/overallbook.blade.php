@extends('layout.template')
@section('title', 'Search Books')
@include('style.overallbookcss')

@section('content')

<h2 class="h2">Issued Books & Barcode Scanner</h2>

    <!-- Print Button -->
    <button class="buttons" onclick="window.print()">Print All Barcodes</button>

    <!-- Barcode Cards -->

    @if($book_issues_count)
    <h3 class="h3">
    |Overall Books Issued:<span class="count">{{ $totalBooks}}</span> | Total Categories: <span class="count">{{ $categories->count() }}</span> |
        Total Issued Books: <span class="count">{{ $book_issues_count }}</span>
    </span>
    </h3>

    <div class="barcode" id="barcode-cards">
        @foreach($barcodes as $item)
            <div class="barcode-card" id="card-{{ $item['issued_id'] }}">
                <h4>{{ $item['book_title'] }}</h4>
                <p><strong>ISBN:</strong> {{ $item['book_isbn'] }}</p>
                <p><strong>Author:</strong> {{ $item['book_author'] }}</p>
                <p><strong>Category:</strong> {{ $item['book_category'] }}</p>
                <p><strong>Publisher:</strong> {{ $item['book_publisher'] }}</p>
                <p><strong>Issued ID:</strong> {{ $item['issued_name'] ?? $item['issued_id'] }}</p>
                <p><strong>Issued To:</strong> {{ $item['user_name'] }}</p>
                <p><strong>Issue Date:</strong> {{ $item['issue_date'] }}</p>
                <p><strong>Status:</strong> {{ $item['status'] }}</p>
                <span class="barcode1">{!! $item['barcode'] !!}</span>
            </div>
        @endforeach
    </div>
    @else
        <p>No issued books found.</p>
    @endif
@endsection