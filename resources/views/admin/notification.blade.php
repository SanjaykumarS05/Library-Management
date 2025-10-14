@extends('layout.template')
@section('title', 'Send Notification')
@include('style.overallbookcss')

@section('content')
<h1>📩 Send Notification</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('notification.store') }}" method="POST">
    @csrf

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>

    <label>Phone:</label>
    <input type="text" name="phone" maxlength="10" 
           oninput="this.value=this.value.replace(/[^0-9]/g,'')" 
           value="{{ old('phone') }}" required>

    <label>Subject:</label>
    <select name="subject" required>
        <option value="">-- Select Subject --</option>
        <option value="Library Update" {{ old('subject') == 'Library Update' ? 'selected' : '' }}>Library Update</option>
        <option value="New Arrivals" {{ old('subject') == 'New Arrivals' ? 'selected' : '' }}>New Arrivals</option>
        <option value="Event Notification" {{ old('subject') == 'Event Notification' ? 'selected' : '' }}>Event Notification</option>
        <option value="Reminder" {{ old('subject') == 'Reminder' ? 'selected' : '' }}>Reminder</option>
    </select>

    <label>Message:</label>
    <textarea name="message" required>{{ old('message') }}</textarea>

    <label>Email Sent To:</label>
    <select name="recipient_id" required>
        <option value="">-- Select User --</option>
        @foreach($recipients as $user)
            <option value="{{ $user->id }}" {{ old('recipient_id') == $user->id ? 'selected' : '' }}>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>

    <button type="submit" class="button3">Send</button>
</form>

<hr>

<h2>📜 Email Log</h2>
@if($logs->isEmpty())
    <p>No emails sent yet.</p>
@else
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Recipient</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Sent At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{ $log->recipient->name }}</td>
                <td>{{ $log->email }} </td>
                <td>{{ $log->subject }}</td>
                <td>{{ $log->status }}</td>
                <td>{{ $log->sent_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $logs->links() }}
@endif
@endsection

