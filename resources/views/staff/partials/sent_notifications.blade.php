<h3>Sent Notifications</h3>
@if($notifications->isEmpty())
    <p>No notifications sent yet.</p>
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
        @foreach($notifications as $log)
        <tr>
            <td>{{ $log->recipient->name }}</td>
            <td>{{ $log->email }}</td>
            <td>{{ $log->subject }}</td>
            <td>{{ $log->status }}</td>
            <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
