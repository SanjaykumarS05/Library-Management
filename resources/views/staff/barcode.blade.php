@extends('layout.template')

@section('title', 'Barcode Management')
@section('header')
    <h1>Barcode Management</h1>
@endsection
@include('Style.barcodecss')

@section('content')
<div class="container">
    <center>
        <h3>📷 Scan Barcode via Camera or Upload Image</h3>

        <!-- Barcode Scanner -->
        <div id="reader" class="barcode-scanner" style="width:400px; height:300px; margin-top:10px;"></div>

        <!-- Camera Controls -->
        <div style="margin-top:10px;">
            <select id="camera-select" style="padding:5px; margin-right:10px;">
                <option disabled selected>Loading cameras...</option>
            </select>
            <button id="start-scan" class="buttons">Start Camera Scan</button>
            <button id="stop-scan" class="buttons" style="background-color:#f44336;">Stop Camera Scan</button>
        </div>

        <h4 style="margin-top:20px;">OR Upload Barcode Image</h4>
        <div id="drop-zone"
             style="border:2px dashed #ccc; border-radius:10px; padding:20px; width:300px; text-align:center; margin:10px auto; cursor:pointer;">
            <p>📤 Drag & Drop Barcode Image Here<br>or Click to Select</p>
            <input type="file" id="barcode-file" accept="image/*" style="display:none;">
        </div>

        <!-- Manual Input -->
        <input type="text" id="barcode" placeholder="Or enter barcode manually" style="padding:8px; width:200px;">
        <button id="barcode-submit" class="buttons small-btn" style="margin-left:5px;">Search</button>

        <p id="scan-result" style="margin-top:10px;">Scan result will appear here</p>
    </center>

    <hr><br>

    <!-- Print All Button -->
    <button class="buttons" onclick="printContent('printable-content')">🖨️ Print All</button>

    <div id="printable-content">
        <div id="book-info"></div>

        <h2>Current Issued Books</h2>
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
                        <p><strong>Due Date:</strong> {{ $item['issue_date']->addDay(15)->format('Y-m-d') }}</p>
                        <p><strong>Status:</strong> {{ $item['status'] }}</p>
                        <p><strong>Barcode ID:</strong> {{ $item['barcodeText'] }}</p>
                        <center><span class="barcode1"><img src="{{ $item['barcodeImage'] }}" alt="Barcode" style="width:150px; height:auto;">
                        </span></center>
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

<!-- ✅ Loading Overlay (for Fetching Info) -->
<div id="loading-overlay" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center;">
    <div style="background:#fff; padding:30px 40px; border-radius:10px; text-align:center;
                box-shadow:0 0 15px rgba(0,0,0,0.3); font-size:18px; color:#2196f3;">
        <div class="spinner" 
             style="border:4px solid #f3f3f3; border-top:4px solid #2196f3; border-radius:50%;
                    width:40px; height:40px; animation:spin 1s linear infinite; margin:auto;"></div>
        <p style="margin-top:15px; font-weight:500;">Fetching book info...</p>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>

<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
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
let html5QrCode;
let currentCameraId = null;
const cameraSelect = document.getElementById('camera-select');

// ✅ Step 1: Load cameras only (don’t start yet)
Html5Qrcode.getCameras().then(cameras => {
    cameraSelect.innerHTML = '';

    if (cameras.length === 0) {
        cameraSelect.innerHTML = '<option disabled>No cameras found</option>';
        return;
    }

    cameras.forEach((cam, index) => {
        const opt = document.createElement('option');
        opt.value = cam.id;
        opt.text = cam.label || `Camera ${index + 1}`;
        cameraSelect.appendChild(opt);
    });

    const laptopCam = cameras.find(c => c.label.toLowerCase().includes('integrated')) || cameras[0];
    cameraSelect.value = laptopCam.id;
    currentCameraId = cameraSelect.value;
}).catch(err => {
    alert('❌ Could not access camera list. Check permissions.');
    console.error(err);
});

// ✅ Start Camera
async function startCamera(cameraId) {
    if (html5QrCode) {
        try { await html5QrCode.stop(); await html5QrCode.clear(); } catch(e){}
    }

    html5QrCode = new Html5Qrcode("reader");
    try {
        await html5QrCode.start(
            { deviceId: { exact: cameraId } },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            decodedText => {
                document.getElementById('scan-result').innerText = `Scanned: ${decodedText}`;
                redirectToBookInfo(decodedText);
            },
            error => console.warn(`QR error: ${error}`)
        );
        console.log("✅ Camera started");
    } catch (err) {
        console.error("Camera start error:", err);
        alert("❌ Could not start camera. Check permissions.");
    }
}

// ✅ Stop Camera
async function stopCamera() {
    if (html5QrCode) {
        try {
            await html5QrCode.stop();
            await html5QrCode.clear();
            console.log("Camera stopped");
        } catch (e) {
            console.error("Error stopping camera:", e);
        }
    }
}

// ✅ Button actions
document.getElementById('start-scan').addEventListener('click', () => {
    const selected = cameraSelect.value;
    if (!selected) return alert('Select a camera first.');
    startCamera(selected);
});
document.getElementById('stop-scan').addEventListener('click', stopCamera);

// ✅ Stop camera when leaving page
window.addEventListener('beforeunload', stopCamera);
document.addEventListener('visibilitychange', () => {
    if (document.hidden) stopCamera();
});

// ✅ File upload / drag & drop
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('barcode-file');
dropZone.addEventListener('click', () => fileInput.click());
dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('dragover'); });
dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file) processBarcodeImage(file);
});
fileInput.addEventListener('change', e => {
    const file = e.target.files[0];
    if (file) processBarcodeImage(file);
});

function processBarcodeImage(file) {
    html5QrCode = new Html5Qrcode("reader");
    html5QrCode.scanFile(file, true)
        .then(decodedText => {
            document.getElementById('scan-result').innerText = `Uploaded Barcode: ${decodedText}`;
            redirectToBookInfo(decodedText);
        })
        .catch(err => {
            console.error(err);
            alert('❌ Could not detect barcode. Try a clearer image.');
        });
}

// ✅ Manual input
document.getElementById('barcode-submit').addEventListener('click', () => {
    const code = document.getElementById('barcode').value.trim();
    if (code) redirectToBookInfo(code);
    else alert('Please enter a barcode.');
});
document.getElementById('barcode').addEventListener('keypress', e => {
    if (e.key === 'Enter') {
        const code = e.target.value.trim();
        if (code) redirectToBookInfo(code);
    }
});

// ✅ Redirect to book info with overlay freeze
function redirectToBookInfo(code) {
    const overlay = document.getElementById('loading-overlay');
    overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden'; // freeze scrolling
    setTimeout(() => {
        window.location.href = `/staff/barcode/book-info/${code}`;
    }, 800);
}

// ✅ Print Functions
function printContent(divId) {
    const content = document.getElementById(divId).innerHTML;
    const win = window.open('', '', 'width=800,height=600');
    win.document.write('<html><head><title>Print Barcode</title>');
    win.document.write('<style>.no-print{display:none!important;}</style>');
    win.document.write('</head><body>');
    win.document.write(content);
    win.document.write('</body></html>');
    win.document.close();
    setTimeout(() => { win.print(); win.close(); }, 500);
}
function printSingle(cardId) {
    const card = document.getElementById(cardId);
    if (!card) return alert('Card not found!');
    const win = window.open('', '', 'height=600,width=400');
    win.document.write(`<html><head><title>Book Card</title><style>.no-print{display:none!important;}</style></head><body>${card.outerHTML}</body></html>`);
    win.document.close();
    win.print();
    win.close();
}
</script>
@endsection
