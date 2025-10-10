@extends('layout.template')
@section('title', 'Barcode Management')
@section('header')
    <h1>Barcode Management</h1>
@endsection
@include('Style.barcodecss')

@section('content')
<div class="container">
<center>
    <h3>Scan Barcode via Camera</h3>
    <div id="reader" class="barcode-scanner" style="width:400px; height:300px;"></div>
    <button id="start-scan" class="buttons">Start Camera Scan</button>
    <button id="stop-scan" class="buttons" style="background-color:#f44336;">Stop Camera Scan</button>
    <p id="scan-result">Scan result will appear here</p>
</center>

    <hr>

    <!-- Book Info -->
    <div id="book-info" style="margin-top:20px;"></div>


     <h2>Issued Books & Barcode Scanner</h2>

    <!-- Print Button -->
    <button class="buttons" onclick="window.print()">Print All Barcodes</button>

    <!-- Barcode Cards -->

    @if($book_issues_count)
    <h3>Total Issued Books: <span class="count">{{ $book_issues_count }}</span></h3>
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
                <center><p class="barcode">{!! $item['barcode'] !!}</p></center>
            </div>
        @endforeach
    </div>
    @else
        <p>No issued books found.</p>
    @endif
    

    <hr>
</div>

<!-- JS Library -->
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    let html5QrcodeScanner = new Html5Qrcode("reader");

    function onScanSuccess(decodedText, decodedResult) {
        document.getElementById('scan-result').innerText = `Scanned Code: ${decodedText}`;
        fetchBookInfo(decodedText);
        highlightCard(decodedText);

        html5QrcodeScanner.stop()
            .then(() => console.log("Camera stopped automatically"))
            .catch(err => console.log(err));
    }

    function onScanFailure(error) {
        // optional: console.log(`Scan failed: ${error}`);
    }

    // Start Camera Scan
    document.getElementById('start-scan').addEventListener('click', function(){
        Html5Qrcode.getCameras().then(cameras => {
            if(cameras && cameras.length) {
                let cameraId = cameras[0].id;
                html5QrcodeScanner.start(
                    cameraId,
                    { fps: 10, qrbox: 250 },
                    onScanSuccess,
                    onScanFailure
                ).catch(err => console.log(err));
            } else {
                alert("No cameras found");
            }
        }).catch(err => console.log(err));
    });

    // Stop Camera Scan
    document.getElementById('stop-scan').addEventListener('click', function(){
        html5QrcodeScanner.stop()
            .then(() => {
                console.log("Camera stopped manually");
                document.getElementById('scan-result').innerText = "Camera scan stopped.";
            })
            .catch(err => console.log(err));
    });


    function fetchBookInfo(barcode) {
        fetch(`/barcode/book-info/${barcode}`)
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const info = data.book;
                document.getElementById('book-info').innerHTML = `
                <div class="barcode-card" id="card-${info.issued_id}">
                    <h3>Book Details</h3>
                    <p><strong>Title:</strong> ${info.title}</p>
                    <p><strong>ISBN:</strong> ${info.isbn}</p>
                    <p><strong>Author:</strong> ${info.author}</p>
                    <p><strong>Category:</strong> ${info.category}</p>
                    <p><strong>Publisher:</strong> ${info.publish_year}</p>
                    <p><strong>Issued ID:</strong> ${info.issued_name} (${info.issue_role})</p>
                    <p><strong>Issued To:</strong> ${info.user_name}</p>
                    <p><strong>Issue Date:</strong> ${info.issue_date}</p>
                    <p><strong>Status:</strong> ${info.status}</p>
                    <center>${info.barcode}</center>
                </div>

            </div>
                `;
            } else {
                document.getElementById('book-info').innerHTML = `<p>No book found for barcode: ${barcode}</p>`;
            }
        })
        .catch(err => {
            console.error('Error fetching book info:', err);
            document.getElementById('book-info').innerHTML = `<p>Error fetching book info</p>`;
        });
    }

    // Highlight the scanned barcode card
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
</script>

@endsection
