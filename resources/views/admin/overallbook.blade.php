@extends('layout.template')
@section('title', 'Search Books')
@include('style.overallbookcss')

@section('content')

<h2 class="h2">Issued Books & Barcode Scanner</h2>

<!-- Global Print Button -->
<button class="buttons" onclick="printContent('content-to-print')">🖨️ Print All</button>

<div id="content-to-print">
    @if($book_issues_count)
        <h3 class="h3">
            | Overall Books Issued: <span class="count">{{ $totalBooks }}</span> |
            Total Categories: <span class="count">{{ $categories->count() }}</span> |
            Total Issued Books: <span class="count">{{ $book_issues_count }}</span>
        </h3>

        <div class="barcode" id="barcode-cards">
            @foreach($barcodes as $item)
                <div class="barcode-card" id="card-{{ $item['barcodeText'] }}" style="position:relative;">

                    <h4>{{ $item['book_title'] }}</h4>
                    <p><strong>ISBN:</strong> {{ $item['book_isbn'] }}</p>
                    <p><strong>Author:</strong> {{ $item['book_author'] }}</p>
                    <p><strong>Category:</strong> {{ $item['book_category'] }}</p>
                    <p><strong>Publisher:</strong> {{ $item['book_publisher'] }}</p>
                    <p><strong>Issued By:</strong> {{ $item['issued_name'] }} ({{ $item['issue_role'] }})</p>
                    <p><strong>Issued To:</strong> {{ $item['user_name'] }}</p>
                    <p><strong>Issue Date:</strong> {{ $item['issue_date'] }}</p>
                    <p><strong>Status:</strong> {{ $item['status'] }}</p><br>
                    <center><span class="barcode1">{!! $item['barcode'] !!}</span></center>

                    <!-- Hidden during printing -->
                    <div class="no-print" style="margin-top:10px;">
                        <button class="buttons small-btn" onclick="printSingle('card-{{ $item['barcodeText'] }}')">🖨️ Print This</button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No issued books found.</p>
    @endif
</div>

<!-- Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>


<script>
// ✅ Print all cards
function printContent(elementId) {
    const content = document.getElementById(elementId)?.innerHTML;
    if (!content) return alert('Content not found!');
    const printWindow = window.open('', '', 'height=600,width=800');

    printWindow.document.write(`
        <html>
            <head>
                <title>Issued Books</title>
                <link rel="stylesheet" href="{{ asset('style/overallbookcss.css') }}" type="text/css" />
                <style>.no-print { display: none !important; }</style>
            </head>
            <body>${content}</body>
        </html>
    `);

    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

// ✅ Print a single card
function printSingle(cardId) {
    const card = document.getElementById(cardId);
    if (!card) return alert('Card not found!');
    const printWindow = window.open('', '', 'height=600,width=400');

    printWindow.document.write(`
        <html>
            <head>
                <title>Book Card</title>
                <link rel="stylesheet" href="{{ asset('style/overallbookcss.css') }}" type="text/css" />
                <style>.no-print { display: none !important; }</style>
            </head>
            <body>${card.outerHTML}</body>
        </html>
    `);

    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
</script>

@endsection
