@extends('layout.template')
@section('title', 'Notifications')
@include('style.overallbookcss')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<h1>📩 Notifications</h1>

<div class="setting-toggle">
    <label><input type="checkbox" id="toggle-requests" checked> Book Requests</label>
    <label><input type="checkbox" id="toggle-received"> Received Emails</label>
    <label><input type="checkbox" id="toggle-sent"> Sent Notifications</label>
</div>

<div class="container setting" id="dynamic-section">
    {{-- Dynamic content will load here --}}
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

    // CSRF Setup
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    function loadSection(data) {
        $.ajax({
            url: "{{ route('notification.dynamic') }}",
            method: 'POST',
            data: data,
            success: function(response) {
                $('#dynamic-section').html(response.html);
            },
            error: function() {
                toastr.error('Something went wrong!');
            }
        });
    }

    // Initially load Book Requests
    loadSection({ book_requests: true });

    function toggleCheckbox(current) {
        $('#toggle-requests, #toggle-received, #toggle-sent').not(current).prop('checked', false);
    }

    $('#toggle-requests').on('change', function() {
        if(this.checked){
            toggleCheckbox(this);
            loadSection({ book_requests: true });
        } else {
            $('#dynamic-section').html('');
        }
    });

    $('#toggle-received').on('change', function() {
        if(this.checked){
            toggleCheckbox(this);
            loadSection({ received_emails: true });
        } else {
            $('#dynamic-section').html('');
        }
    });

    $('#toggle-sent').on('change', function() {
        if(this.checked){
            toggleCheckbox(this);
            loadSection({ sent_notifications: true });
        } else {
            $('#dynamic-section').html('');
        }
    });

});
</script>
@endsection
