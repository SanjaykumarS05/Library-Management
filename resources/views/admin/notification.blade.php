@extends('layout.template')
@section('title', 'Notifications')
@include('userstyle.notificationcss')
@section('content')
<h1>📩 Notifications Dashboard</h1>

{{-- SECTION TOGGLES --}}
<div class="setting-toggle">
    <label><input type="checkbox" id="toggle-book" checked> Book Requests</label>
    <label><input type="checkbox" id="toggle-received"> Received Notifications</label>
    <label><input type="checkbox" id="toggle-sent"> Sent Notifications</label>
</div>

<div class="container setting">

    {{-- ==================== BOOK REQUESTS SECTION ==================== --}}
    <div id="book-section">
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
                        <th>ISBN</th>
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
                        <td>{{ $request->book->isbn ?? 'N/A' }}</td>
                        <td>{{ $request->Comments ?? 'N/A' }}</td>
                        <td>
                            @if($request->status === 'approved')
                                <span style="color:green;font-weight:bold;">Approved</span>
                            @else
                                <form method="post" action="{{ route('bookrequests.updateStatus', $request->id) }}">
                                    @csrf
                                    <select name="status" class="status-select">
                                        @foreach($statusOptions as $status)
                                            <option value="{{ $status }}" {{ $request->status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- ==================== RECEIVED NOTIFICATIONS ==================== --}}
    <div id="received-section" style="display:none;">
        <h3>Received Notifications</h3>

        @if($logs->isEmpty())
            <p>No emails sent yet.</p>
        @else
            <table border="1" cellpadding="8">
                <thead>
                    <tr>
                        <th>Recipient</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Type</th>
                        <th>Sent At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->recipient->name ?? 'N/A' }}</td>
                            <td>{{ $log->email ?? 'N/A' }}</td>
                            <td>{{ $log->subject ?? 'N/A' }}</td>
                            <td>{{ $log->type ?? 'N/A' }}</td>
                            <td>{{ $log->sent_at ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- ==================== SENT NOTIFICATIONS ==================== --}}
    <div id="sent-section" style="display:none;">
        <h3>Sent Notifications</h3>

        <form id="send-email-form" method="POST" action="{{ route('admin.sendEmail') }}">
        @csrf

        <label for="recipient">Recipient:</label>
        <select id="recipient" name="recipient_id">
            <option value="">Select a user</option>
            <option value="all">All Users</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>
        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject">

        <label for="type">Type:</label>
        <select id="type" name="type">
            <option value="offers">Offers</option>
            <option value="updates">Updates</option>
            <option value="alerts">Alerts</option>
            <option value="other">Other</option>
        </select>

        <div id="other-type-wrapper">
            <label for="other-type">Specify Type:</label>
            <input type="text" id="other-type" name="other_type" required>
        </div>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" cols="50"></textarea>
        <button type="submit" id="send-email-btn">Send Email</button>
    </form>

</div>
@endsection


@section('scripts')
<script>
$(document).ready(function() {

    // ===== STATUS SUBMIT =====
    $('.status-select').on('change', function() {
        if(this.value === 'rejected' && !confirm("Reject this request?")) return;
        $(this).closest('form').submit();
    });

    // ===== TOGGLE SECTIONS ONE AT A TIME =====
    function showOnly(section) {
        $('#book-section, #received-section, #sent-section').slideUp();
        $(section).slideDown();

        $('#toggle-book, #toggle-received, #toggle-sent').prop('checked', false);
        if(section === '#book-section') $('#toggle-book').prop('checked', true);
        if(section === '#received-section') $('#toggle-received').prop('checked', true);
        if(section === '#sent-section') $('#toggle-sent').prop('checked', true);
    }

    $('#toggle-book').on('change', () => showOnly('#book-section'));
    $('#toggle-received').on('change', () => showOnly('#received-section'));
    $('#toggle-sent').on('change', () => showOnly('#sent-section'));

});

document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const otherWrapper = document.getElementById('other-type-wrapper');

    function toggleOtherInput() {
        if (typeSelect.value === 'other') {
            otherWrapper.style.display = 'block';
        } else {
            otherWrapper.style.display = 'none';
        }
    }

    // run on page load
    toggleOtherInput();

    // run on dropdown change
    typeSelect.addEventListener('change', toggleOtherInput);
});
</script>
@endsection
