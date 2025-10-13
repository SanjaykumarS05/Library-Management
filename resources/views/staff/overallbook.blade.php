@extends('layout.template')
@section('title', 'Search Books')
@include('style.overallbookcss')

@section('content')

<h2 class="h2">Issued Books & Barcode Scanner</h2>

<button class="buttons" onclick="printContent('content-to-print')">Print</button>
<button class="buttons" onclick="downloadContentAsImage('content-to-print')">Download as Image</button>

<div id="content-to-print">
    @if($book_issues_count)
        <h3 class="h3">
            | Overall Books Issued: <span class="count">{{ $totalBooks }}</span> |
            Total Categories: <span class="count">{{ $categories->count() }}</span> |
            Total Issued Books: <span class="count">{{ $book_issues_count }}</span>
        </h3>

        <div class="barcode" id="barcode-cards">
            @foreach($barcodes as $item)
                <div class="barcode-card" id="card-{{ $item['issued_id'] }}">
                    <h4>{{ $item['book_title'] }}</h4>
                    <p><strong>ISBN:</strong> {{ $item['book_isbn'] }}</p>
                    <p><strong>Author:</strong> {{ $item['book_author'] }}</p>
                    <p><strong>Category:</strong> {{ $item['book_category'] }}</p>
                    <p><strong>Publisher:</strong> {{ $item['book_publisher'] }}</p>
                    <p><strong>Issued ID:</strong> {{ $item['issued_name'] }} ({{ $item['issue_role'] }})</p>
                    <p><strong>Issued To:</strong> {{ $item['user_name'] }}</p>
                    <p><strong>Issue Date:</strong> {{ $item['issue_date'] }}</p>
                    <p><strong>Status:</strong> {{ $item['status'] }}</p>
                    <center><span class="barcode1">{!! $item['barcode'] !!}</span></center>
                </div>
            @endforeach
        </div>
    @else
        <p>No issued books found.</p>
    @endif

</div>

<!-- Libraries for download as image -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>

<!-- Print and Download JS -->
<script>
function printContent(elementId) {
    var content = document.getElementById(elementId).innerHTML;
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Issued Books</title>');
    printWindow.document.write('<link rel="stylesheet" href="{{ asset('style/overallbookcss.css') }}" type="text/css" />');
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

function downloadContentAsImage(divId) {
    let node = document.getElementById(divId);
    if(!node) return alert('Content not found!');

    domtoimage.toPng(node, { bgcolor: '#ffffff', width: node.scrollWidth, height: node.scrollHeight })
    .then(function (dataUrl) {
        let link = document.createElement('a');
        link.download = 'issued-books.png';
        link.href = dataUrl;
        link.click();
    })
    .catch(function (error) {
        console.error('Error downloading content:', error);
        alert('Failed to download content as image.');
    });
}
</script>

@endsection
