<h3>Received Emails</h3>
@if($emails->isEmpty())
    <p>No received emails.</p>
@else
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>From</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Received At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($emails as $email)
        <tr>
            <td>{{ $email->sender_name }}</td>
            <td>{{ $email->email }}</td>
            <td>{{ $email->subject }}</td>
            <td>{{ $email->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
