<h3>Book Requests</h3>
@if($bookRequests->isEmpty())
    <p>No requests found.</p>
@else
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>User</th>
            <th>Book</th>
            <th>Request Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookRequests as $req)
        <tr>
            <td>{{ $req->user->name }}</td>
            <td>{{ $req->book->title }}</td>
            <td>{{ $req->created_at->format('d-m-Y') }}</td>
            <td>{{ ucfirst($req->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
