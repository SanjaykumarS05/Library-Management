@extends('layout.template')
@section('title', 'Overall Issued Books')
@include('style.overallbookcss')

@section('content')

<h2 class="h2">Overall Issued Books</h2>

<div class="filter-bar" style="margin: 10px 0; display:flex; gap:10px; align-items:center;">
    <input type="text" id="titleSearch" placeholder="Search by Title or Book Id" style="width:300px; padding:8px;">
    <input type="text" id="isbnSearch" placeholder="Search by ISBN" maxlength="13" style="width:300px; padding:8px;">
    <input type="text" id="authorSearch" placeholder="Search by Author" style="width:300px; padding:8px;">
    <input type="text" id="yearSearch" placeholder="Search by Published year" maxlength="4" style="width:300px; padding:8px;">
    <select id="categoryFilter" style="padding:8px; width:200px;">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <select id="statusFilter" style="padding:8px; width:200px;">
        <option value="">All Status</option>
        <option value="issued">Issued</option>
        <option value="returned">Returned</option>
        <option value="overdue">Overdue</option>
    </select>
    <a href="{{ route('staff.overallbook.index') }}" class="btn btn-secondary">Reset</a>
</div>
<center>
    <h3 class="h3"> | Overall Books Issued: <span class="count">{{ $totalBooks }}</span> |
                     Total Categories: <span class="count">{{ $categories->count() }}</span> |
                     Current Issued Books: <span class="count">{{ $issuedbook }}</span> 
    </h3>
</center>
<br>

<div id="report-table">
    <div id="content-to-print">
        @if($book_issues_count)
            <div class="barcode" id="barcode-cards">
                @include('admin.overallbooks_table', ['barcodes' => $barcodes])
            </div>
        @else
            <p>No issued books found.</p>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function fetchResults() {
        let data = {
            title: $('#titleSearch').val(),
            isbn: $('#isbnSearch').val(),
            author: $('#authorSearch').val(),
            year: $('#yearSearch').val(),
            category_id: $('#categoryFilter').val(),
            status: $('#statusFilter').val()
        };

        $.ajax({
            url: "{{ route('staff.overallbooks.search') }}",
            type: 'GET',
            data: data,
            success: function (response) {
                $('#barcode-cards').html(response);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Trigger AJAX when typing in any search box
    $('#titleSearch, #isbnSearch, #authorSearch, #yearSearch').on('keyup', fetchResults);

    // Trigger when dropdowns change
    $('#categoryFilter, #statusFilter').on('change', fetchResults);
});

// 🖨️ Print Single Card
function printSingle(cardId) {
    const cardElement = document.getElementById(cardId);
    if (!cardElement) {
        console.error('Card element not found:', cardId);
        return;
    }
    const printWindow = window.open('', '', 'height=600,width=800');
    const cardClone = cardElement.cloneNode(true);
    // Remove the print button from the cloned element
    cardClone.querySelector('.no-export')?.remove();

    printWindow.document.write(` ${cardClone.innerHTML}`);
    printWindow.document.close();
    printWindow.print();
}
</script>
@endsection