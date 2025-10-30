@extends('layout.template')
@section('title', 'Overdue Books')
@include('style.editcss')

@section('content')
<div class="container mt-5">
    <h1 class="h1">Overdue Books</h1>

    <form action="{{ route('returnBookPayment') }}" method="POST" id="returnForm" class="mt-4">
        @csrf

        @foreach($overdue as $issue)
            @php
                $issueDate = \Carbon\Carbon::parse($issue->issue_date);
                $dueDate = $issueDate->copy()->addDays(15);
                $today = now();
                $overdueDays = $today->greaterThan($dueDate) ? $dueDate->diffInDays($today) : 0;
                $finePerDay = 10;
                $totalFine = $overdueDays * $finePerDay;
            @endphp

            {{-- Hidden required form values --}}
            <input type="hidden" name="issue_id" value="{{ $issue->id }}">
            <input type="hidden" name="user_id_return" value="{{ $issue->user_id }}">
            <input type="hidden" name="fine_amount" value="{{ $totalFine }}">

            <div class="form-group mb-3">
                <label>User Name</label>
                <input type="text" class="form-control" value="{{ $issue->user->name }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label>Book Title</label>
                <input type="text" class="form-control" value="{{ $issue->book->title }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label>Issue Date</label>
                <input type="text" class="form-control" value="{{ $issueDate->format('M d, Y') }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label>Due Date</label>
                <input type="text" class="form-control" value="{{ $dueDate->format('M d, Y') }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label>Days Overdue</label>
                <input type="text" class="form-control text-danger" value="{{ $overdueDays }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label>Fine Amount</label>
                <input type="text" class="form-control text-danger fw-bold" value="₹{{ $totalFine }}" readonly>
            </div>

            <div class="form-group mb-4">
                <label>Select Payment Method</label>
                <select name="payment_method" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option value="cash">Cash</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="upi">UPI</option>
                </select>
            </div>

            <hr>
        @endforeach

        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Confirm Return & Pay</button>
    </form>
</div>

<!-- ✅ Loading Overlay -->
<div id="loading-overlay"
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center;">
    <div style="background:#fff; padding:30px 40px; border-radius:10px; text-align:center;
                box-shadow:0 0 15px rgba(0,0,0,0.3); font-size:18px; color:#2196f3;">
        <div class="spinner"
             style="border:4px solid #f3f3f3; border-top:4px solid #2196f3; border-radius:50%;
                    width:40px; height:40px; animation:spin 1s linear infinite; margin:auto;"></div>
        <p style="margin-top:15px; font-weight:500;">Processing Payment...</p>
    </div>
</div>

<!-- ✅ Spinner Animation -->
<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

<!-- ✅ Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('returnForm');
    const overlay = document.getElementById('loading-overlay');

    if (form) {
        form.addEventListener('submit', function() {
            overlay.style.display = 'flex';
        });
    }
});
</script>
@endsection
