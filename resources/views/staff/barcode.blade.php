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

        <!-- Camera Buttons -->
        <button id="start-scan" class="buttons">Start Camera Scan</button>
        <button id="stop-scan" class="buttons" style="background-color:#f44336;">Stop Camera Scan</button>

        <!-- OR Upload Barcode -->
        <h4 style="margin-top:15px;">OR Upload Barcode Image</h4>

        <!-- Drag & Drop Zone -->
        <div id="drop-zone" 
             style="border:2px dashed #ccc; border-radius:10px; padding:20px; width:300px; text-align:center; margin:10px auto; cursor:pointer;">
            <p>📤 Drag & Drop Barcode Image Here<br>or Click to Select</p>
            <input type="file" id="barcode-file" accept="image/*" style="display:none;">
        </div>

        <p id="scan-result" style="margin-top:10px;">Scan result will appear here</p>
    </center>

    <hr><br>

    <!-- Print All Button -->
    <button class="buttons" onclick="printContent('printable-content')">🖨️ Print All</button>

    <div id="printable-content">
        <div id="book-info" style="margin-top:20px;"></div>

        <h2>Issued Books</h2>
        @if($book_issues_count)
            <h3>Total Issued Books: <span class="count">{{ $book_issues_count }}</span></h3>
            <br>
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
                        <p><strong>Issue Date:</strong> {{ $item['issue_date']->format('Y-m-d') }}</p>
                        <p><strong>Status:</strong> {{ $item['status'] }}</p><br>
                        <center><span class="barcode1">{!! $item['barcode'] !!}</span></center>

                        <!-- Download PDF / Print Buttons -->
                        <div class="no-print" style="margin-top:10px;">
                            <button class="buttons small-btn" onclick="printSingle('card-{{ $item['barcodeText'] }}')">🖨️ Print</button>
                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>

<style>
@media print {
    .no-print { display: none !important; }
}

#drop-zone.dragover {
    background-color: #f0f8ff;
    border-color: #2196f3;
    color: #2196f3;
}
</style>

<script>
// ✅ GLOBAL SCANNER INSTANCE
let html5QrcodeScanner = new Html5Qrcode("reader");

// ✅ CAMERA SCAN SUCCESS
function onScanSuccess(decodedText) {
    document.getElementById('scan-result').innerText = `Scanned Code: ${decodedText}`;
    window.location.href = `/staff/barcode/book-info/${decodedText}`;
}

// ✅ CAMERA SCAN FAILURE
function onScanFailure(error) {
    console.log('Scan error:', error);
}

// ✅ START CAMERA SCAN
document.getElementById('start-scan').addEventListener('click', function() {
    Html5Qrcode.getCameras().then(cameras => {
        if (cameras && cameras.length) {
            html5QrcodeScanner.start(
                cameras[0].id,
                { fps: 10, qrbox: 250 },
                onScanSuccess,
                onScanFailure
            ).catch(err => console.log("Start error:", err));
        } else {
            alert("No cameras found");
        }
    }).catch(err => console.log("Camera fetch error:", err));
});

// ✅ STOP CAMERA SCAN
document.getElementById('stop-scan').addEventListener('click', function() {
    html5QrcodeScanner.stop()
        .then(() => console.log("Camera stopped successfully"))
        .catch(err => console.error("Error stopping camera:", err));
});

// ✅ DRAG & DROP BARCODE UPLOAD
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('barcode-file');

dropZone.addEventListener('click', () => fileInput.click());

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('dragover');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('dragover');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file) processBarcodeImage(file);
});

fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) processBarcodeImage(file);
});

// ✅ PROCESS BARCODE IMAGE
function processBarcodeImage(file) {
    html5QrcodeScanner.scanFile(file, true)
        .then(decodedText => {
            document.getElementById('scan-result').innerText = `Uploaded Barcode: ${decodedText}`;
            window.location.href = `/staff/barcode/book-info/${decodedText}`;
        })
        .catch(err => {
            console.error(err);
            alert('Could not detect barcode. Try a clearer image.');
        });
}


// ✅ PRINT SINGLE CARD
function printSingle(cardId) {
    const card = document.getElementById(cardId);
    if (!card) return alert('Card not found!');
    const win = window.open('', '', 'height=600,width=400');
    win.document.write(`
        <html>
            <head>
                <title>Book Card</title>
                <link rel="stylesheet" href="{{ asset('style/overallbookcss.css') }}" type="text/css" />
                <style>.no-print { display: none !important; }</style>
            </head>
            <body>${card.outerHTML}</body>
        </html>
    `);
    win.document.close();
    win.focus();
    win.print();
    win.close();
}

</script>
@endsection
