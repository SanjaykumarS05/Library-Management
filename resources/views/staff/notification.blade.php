@extends('layout.template')
@section('title', 'Notifications')
@include('userstyle.notificationcss')

@section('content')
<h1>📩 Notifications Dashboard</h1>

{{-- SECTION TOGGLES --}}
<div class="setting-toggle">
    <label><input type="checkbox" id="toggle-book" checked> 
        Book Requests
        @if($hasPendingRequests>0)
            <span class="notify-badge">{{ $hasPendingRequests }}</span>
        @endif
    </label>
    <label><input type="checkbox" id="toggle-received"> Received Notifications</label>
    <label><input type="checkbox" id="toggle-send"> Send Notifications</label>
    <label><input type="checkbox" id="toggle-sent-logs"> Sent Logs</label>
</div>

<div class="container setting">

    {{-- BOOK REQUESTS SECTION --}}
    <div id="book-section" style="display:none;">
        <h3>Book Requests</h3>
        <div id="book-content">
            @if($bookRequests->isEmpty())
                <p>No book requests found.</p>
            @else
                <table class="table">
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
                                    <span class="text-success font-weight-bold">Approved</span>
                                @else
                                    <form method="post" action="{{ route('staff.bookrequests.updateStatus', $request->id) }}">
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
            <div class="pagination-wrapper mt-4">
                {{ $bookRequests->appends(['section' => 'book'])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- RECEIVED NOTIFICATIONS --}}
    <div id="received-section" style="display:none;">
        <h3>Received Notifications</h3>
        <div id="received-content">
            @if($logs->isEmpty())
                <p>No emails received yet.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Subject</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Received At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->recipient->name ?? 'N/A' }}</td>
                                <td>{{ $log->subject ?? 'N/A' }}</td>
                                <td>{{ $log->type ?? 'N/A' }}</td>
                                <td>{{ $log->message ?? 'N/A' }}</td>
                                <td>{{ $log->sent_at ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="pagination-wrapper mt-4">
                {{ $logs->appends(['section' => 'received'])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- SEND NOTIFICATIONS --}}
    <div id="send-section" style="display:none;">
        <h3>Send Notification</h3>
        <form id="send-email-form" method="POST" action="{{ route('staff.sendEmail') }}">
            @csrf
            <label for="recipient">Recipient:</label>
            <select id="recipient" name="recipient_id" required>
                <option value="">Select a user</option>
                <option value="all">All Users</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" required>

            <label for="type">Type:</label>
            <select id="type" name="type" required>
                <option value="offers">Offers</option>
                <option value="updates">Updates</option>
                <option value="alerts">Alerts</option>
                <option value="other">Other</option>
            </select>

            <div id="other-type-wrapper" style="display:none;">
                <label for="other-type">Specify Type:</label>
                <input type="text" id="other-type" name="other_type">
            </div>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
            <button type="submit" id="send-email-btn">Send Email</button>
        </form>
    </div>

    {{-- SENT LOGS --}}
    <div id="sent-logs-section" style="display:none;">
        <h3>Sent Logs</h3>
        <div id="sent-logs-content">
            @if($sentLogs->isEmpty())
                <p>No emails sent yet.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Subject</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Sent At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sentLogs as $log)
                            <tr>
                                <td>{{ $log->recipient->name ?? 'N/A' }}</td>
                                <td>{{ $log->subject ?? 'N/A' }}</td>
                                <td>{{ $log->type ?? 'N/A' }}</td>
                                <td>{{ $log->message ?? 'N/A' }}</td>
                                <td>{{ $log->sent_at ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="pagination-wrapper mt-4">
                {{ $sentLogs->appends(['section' => 'sentlogs'])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Track current active section
    let currentSection = 'book';
    
    // Show book section by default
    $('#book-section').show();
    $('#toggle-book').prop('checked', true);
    
    // ===== TOGGLE SECTIONS =====
    function showOnly(section) {
        $('#book-section, #received-section, #send-section, #sent-logs-section').slideUp();
        $(section).slideDown();
        
        currentSection = section.replace('#', '').replace('-section', '');

        $('#toggle-book, #toggle-received, #toggle-send, #toggle-sent-logs').prop('checked', false);
        if(section === '#book-section') $('#toggle-book').prop('checked', true);
        if(section === '#received-section') $('#toggle-received').prop('checked', true);
        if(section === '#send-section') $('#toggle-send').prop('checked', true);
        if(section === '#sent-logs-section') $('#toggle-sent-logs').prop('checked', true);
        
        // Update URL without page reload
        const url = new URL(window.location);
        url.searchParams.set('section', currentSection);
        window.history.replaceState({}, '', url);
    }

    // ===== TOGGLE BUTTON ACTIONS =====
    $('#toggle-book').on('change', () => showOnly('#book-section'));
    $('#toggle-received').on('change', () => showOnly('#received-section'));
    $('#toggle-send').on('change', () => showOnly('#send-section'));
    $('#toggle-sent-logs').on('change', () => showOnly('#sent-logs-section'));

    // ===== STATUS CHANGE =====
    $(document).on('change', '.status-select', function() {
        if(this.value === 'rejected' && !confirm("Reject this request?")) return;
        $(this).closest('form').submit();
    });

    // ===== AJAX PAGINATION =====
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        
        const url = $(this).attr('href');
        const section = currentSection;
        
        if (!section) return;
        
        // Show loading indicator
        const $content = $(`#${section}-content`);
        $content.html('<div class="text-center p-4">Loading...</div>');
        
        // Make AJAX request
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                // Create a temporary element to parse the response
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data;
                
                // Extract the relevant content
                const content = tempDiv.querySelector(`#${section}-content`);
                if (content) {
                    $(`#${section}-content`).html(content.innerHTML);
                } else {
                    // Fallback: try to find the section in the response
                    const sectionElement = tempDiv.querySelector(`#${section}-section`);
                    if (sectionElement) {
                        const sectionContent = sectionElement.querySelector(`#${section}-content`);
                        if (sectionContent) {
                            $(`#${section}-content`).html(sectionContent.innerHTML);
                        }
                    } else {
                        $(`#${section}-content`).html('<div class="text-center text-danger p-4">Error loading content</div>');
                    }
                }
            },
            error: function() {
                $(`#${section}-content`).html('<div class="text-center text-danger p-4">Error loading content</div>');
            }
        });
    });

    // ===== OPEN CORRECT SECTION FROM URL =====
    let urlSection = new URLSearchParams(window.location.search).get('section');
    if(urlSection){
        showOnly(`#${urlSection}-section`);
    }

    // ===== TOGGLE "OTHER" TYPE INPUT =====
    const typeSelect = document.getElementById('type');
    const otherWrapper = document.getElementById('other-type-wrapper');
    const otherInput = document.getElementById('other-type');

    function toggleOtherInput() {
        if(typeSelect.value === 'other') {
            otherWrapper.style.display = 'block';
            otherInput.required = true;
        } else {
            otherWrapper.style.display = 'none';
            otherInput.required = false;
        }
    }

    toggleOtherInput();
    typeSelect.addEventListener('change', toggleOtherInput);
});
</script>

<style>
.text-center {
    text-align: center;
}

.p-4 {
    padding: 1.5rem;
}

.text-danger {
    color: #dc3545;
}
</style>
@endsection