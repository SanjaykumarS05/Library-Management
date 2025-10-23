@extends('layout.template')
@section('title', 'Notifications')
@include('style.overallbookcss')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<h1>📩 Book Requests</h1>

<div class="container setting" id="dynamic-section">
    <h3>Book Requests</h3>

    @if($bookRequests->isEmpty())
        <p>No book requests found.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>User Name</th>
                    <th>Book Title</th>
                    <th>Comments</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookRequests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $request->user->name ?? 'N/A' }}</td>
                    <td>{{ $request->book->title ?? 'N/A' }}</td>
                    <td>{{ $request->Comments ?? 'N/A' }}</td>
                    <td>
                        <form method="post" action="{{ route('bookrequests.updateStatus', $request->id) }}" class="status-form">
                            @csrf
                            <select name="status" class="status-select">
                                @foreach($statusOptions as $status)
                                    <option value="{{ $status }}" {{ $request->status === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- ✅ Confirmation Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const selected = this.value.toLowerCase();

            if (selected === 'rejected') {
                const confirmReject = confirm('Are you sure you want to reject this book request?');
                if (!confirmReject) {
                    // Reset the dropdown to previous value
                    this.selectedIndex = [...this.options].findIndex(o => o.defaultSelected);
                    return;
                }
            }

            // Submit the form if not cancelled
            this.form.submit();
        });
    });
});
</script>

@endsection
