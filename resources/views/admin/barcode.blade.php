@extends('layout.template')

@section('title', 'Barcode Management')
@section('header')
    <h1>Barcode Management</h1>
@endsection
@include('Style.barcodecss')

@section('content')
<div class="container">
    <center>
        <h3>Scan Barcode via Camera or Upload Image</h3>

        <!-- Barcode Scanner -->
        <div id="reader" class="barcode-scanner" style="width:400px; height:300px;"></div>

        <!-- Buttons -->
        <button id="start-scan" class="buttons">Start Camera Scan</button>
        <button id="stop-scan" class="buttons" style="background-color:#f44336;">Stop Camera Scan</button>

        <!-- OR -->
        <h4 style="margin-top:15px;">OR Upload Barcode Image</h4>
        <input type="file" id="barcode-file" accept="image/*" class="buttons" style="width:250px;">
        
        <p id="scan-result" style="margin-top:10px;">Scan result will appear here</p>
    </center>

    <hr>
    <br>

    <!-- Print / Download Buttons -->
    <button class="buttons" onclick="printContent('printable-content')">Print</button>
    <button class="buttons" onclick="downloadContentAsImage('printable-content')">Download as Image</button>

    <div id="printable-content">
        <!-- Dynamic Book Info -->
        <div id="book-info" style="margin-top:20px;"></div>

        <h2>Issued Books</h2>
        @if($book_issues_count)
            <h3>Total Issued Books: <span class="count">{{ $book_issues_count }}</span></h3>
            <div class="barcode" id="barcode-cards">
                @foreach($barcodes as $item)
                    <div class="barcode-card" id="card-{{ $item['barcodeText'] }}">
                        <h4>{{ $item['book_title'] }}</h4>
                        <p><strong>ISBN:</strong> {{ $item['book_isbn'] }}</p>
                        <p><strong>Author:</strong> {{ $item['book_author'] }}</p>
                        <p><strong>Category:</strong> {{ $item['book_category'] }}</p>
                        <p><strong>Publisher:</strong> {{ $item['book_publisher'] }}</p>
                        <p><strong>Issued Name:</strong> {{ $item['issued_name']}} ({{ $item['issue_role'] }})</p>
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
    <hr>
</div>

<!-- Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let html5QrcodeScanner = new Html5Qrcode("reader");

// CAMERA SCAN SUCCESS
function onScanSuccess(decodedText) {
    document.getElementById('scan-result').innerText = `Scanned Code: ${decodedText}`;
    fetchBookInfo(decodedText);
    highlightCard(decodedText);
    html5QrcodeScanner.stop().catch(err => console.log(err));
}

// CAMERA SCAN FAILURE (OPTIONAL)
function onScanFailure(error) {
    // console.log(error);
}

// START CAMERA SCAN
document.getElementById('start-scan').addEventListener('click', function(){
    Html5Qrcode.getCameras().then(cameras => {
        if(cameras && cameras.length) {
            html5QrcodeScanner.start(cameras[0].id, { fps: 10, qrbox: 250 }, onScanSuccess, onScanFailure)
                .catch(err => console.log(err));
        } else alert("No cameras found");
    }).catch(err => console.log(err));
});

// STOP CAMERA SCAN
document.getElementById('stop-scan').addEventListener('click', function(){
    html5QrcodeScanner.stop().catch(err => console.log(err));
});

// 📸 UPLOAD BARCODE IMAGE
document.getElementById('barcode-file').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (!file) return;

    const html5QrCode = new Html5Qrcode("reader");
    html5QrCode.scanFile(file, true)
    .then(decodedText => {
        document.getElementById('scan-result').innerText = `Uploaded Barcode: ${decodedText}`;
        fetchBookInfo(decodedText);
        highlightCard(decodedText);
    })
    .catch(err => {
        console.error(err);
        alert('Could not detect barcode from image. Try a clearer photo.');
    });
});

// FETCH BOOK INFO
function fetchBookInfo(barcode) {
    fetch(`/barcode/book-info/${barcode}`)
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            const info = data.book;
            document.getElementById('book-info').innerHTML = `
            <div class="barcode-card" id="card-${info.id || barcode}">
                <h3>Book Details</h3>
                <p><strong>Title:</strong> ${info.title}</p>
                <p><strong>ISBN:</strong> ${info.isbn}</p>
                <p><strong>Author:</strong> ${info.author}</p>
                <p><strong>Category:</strong> ${info.category}</p>
                <p><strong>Publisher:</strong> ${info.publish_year}</p>
                <p><strong>Issued Name:</strong> ${info.issued_name || 'UNKNOWN'} (${info.issue_role || 'UNKNOWN'})</p>
                <p><strong>Issued To:</strong> ${info.user_name || 'UNKNOWN'}</p>
                <p><strong>Issue Date:</strong> ${info.issue_date || 'UNKNOWN'}</p>
                <p><strong>Status:</strong> ${info.status || 'UNKNOWN'}</p>
                <center><span class="barcode1">${info.barcode || ''}</span></center>
            </div>`;
        } else {
            document.getElementById('book-info').innerHTML = `<p>No book found for barcode: ${barcode}</p>`;
        }
    })
    .catch(err => console.error(err));
}

// HIGHLIGHT SCANNED CARD
function highlightCard(barcode) {
    document.querySelectorAll('.barcode-card').forEach(card => {
        card.style.borderColor = '#ddd';
        card.style.boxShadow = '0 4px 10px rgba(0,0,0,0.1)';
    });
    let card = document.getElementById(`card-${barcode}`);
    if(card) {
        card.style.borderColor = '#4CAF50';
        card.style.boxShadow = '0 4px 15px rgba(76,175,80,0.4)';
        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

// PRINT CONTENT
function printContent(divId) {
    let content = document.getElementById(divId).innerHTML;
    let myWindow = window.open('', '', 'width=800,height=600');
    myWindow.document.write('<html><head><title>Print Barcode</title>');
    myWindow.document.write('<link rel="stylesheet" href="{{ asset("Style/barcodecss.css") }}" type="text/css" />');
    myWindow.document.write('</head><body>');
    myWindow.document.write(content);
    myWindow.document.write('</body></html>');
    myWindow.document.close();
    setTimeout(() => { myWindow.focus(); myWindow.print(); myWindow.close(); }, 500);
}

// DOWNLOAD AS IMAGE
function downloadContentAsImage(divId) {
    let node = document.getElementById(divId);
    if(!node) return alert('Content not found!');

    domtoimage.toPng(node, { bgcolor: '#ffffff', width: node.scrollWidth, height: node.scrollHeight })
    .then(function (dataUrl) {
        let link = document.createElement('a');
        link.download = 'barcode-content.png';
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
