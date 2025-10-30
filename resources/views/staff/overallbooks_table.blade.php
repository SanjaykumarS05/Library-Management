<!-- <h4 class="h4">Number of Details Fetched: <span class="count">{{ $countOnPage ?? count($barcodes) }}</span></h4> -->
@foreach($barcodes as $item)
    <div class="barcode-card" id="card-{{ $item['barcodeText'] }}" style="position:relative;">
        <h4>{{ $item['book_title'] }}</h4>
        <p><strong>ISBN:</strong> {{ $item['book_isbn'] }}</p>
        <p><strong>Author:</strong> {{ $item['book_author'] }}</p>
        <p><strong>Category:</strong> {{ $item['book_category'] }}</p>
        <p><strong>Publisher:</strong> {{ $item['book_publisher'] }}</p>
        <p><strong>Issued By:</strong> {{ $item['issued_name'] }} ({{ $item['issue_role'] }})</p>
        <p><strong>Issued To:</strong> {{ $item['user_name'] }}</p>
        <p><strong>Issue Date:</strong> {{ $item['issue_date']->format('Y-m-d') }}</p>
        <p><strong>Due Date:</strong> {{ $item['issue_date']->addDay(15)->format('Y-m-d') }}</p>
        <p><strong>Return Date:</strong> {{ $item['return_date'] ?? '-' }}</p>
        <p><strong>Status:</strong> {{ $item['status'] }}</p>
        <p><strong>Barcode ID:{{$item['barcodeText']}}</strong></p>
        <span class="barcode1">{!! $item['barcode'] !!}</span>

        <div class="no-export"  style="margin-top:10px;">
            <button class="buttons small-btn" onclick="printSingle('card-{{ $item['barcodeText'] }}')">🖨️ Print This</button>
        </div>
    </div>
@endforeach
