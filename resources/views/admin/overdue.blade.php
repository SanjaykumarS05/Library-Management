@extends('layout.template')
@section('title', 'Overdue Books')
@include('style.editcss')

@section('content')
<h1 class="h1">Overdue Books</h1>

<form action="{{ route('returnBookPayment') }}" method="POST" class="mt-4">
    @csrf

    @foreach($overdue as $issue)
        @php
            $issueDate = \Carbon\Carbon::parse($issue->issue_date);
            $dueDate = $issueDate->copy()->addDays(15);
            $today = now();
            $overdueDays = $today->greaterThan($dueDate) ? $dueDate->diffInDays($today) : 0;
            $finePerDay = 100;
            $totalFine = $overdueDays * $finePerDay;
        @endphp

        {{-- Hidden required form values --}}
        <input type="hidden" name="issue_id" value="{{ $issue->id }}">
        <input type="hidden" name="user_id_return" value="{{ $issue->user_id }}">

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
            <input type="text" class="form-control" value="{{ $overdueDays }}" readonly>
        </div>

        <div class="form-group mb-3">
            <label>Fine Amount</label>
            <input type="text" class="form-control" value="₹{{ $totalFine }}" readonly>
            <input type="hidden" name="fine_amount" value="{{ $totalFine }}">
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
    @endforeach

    <button type="submit" class="btn btn-primary">Confirm Return & Pay</button>
</form>
@endsection
