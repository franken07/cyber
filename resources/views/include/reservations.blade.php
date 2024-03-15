<h2>Reservation Details</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>User Name</th>
                <th>Admin Email</th>
                <th>Phone</th>
                <th>Admin ID</th>
                <th>Admin Name</th>
                <th>User Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->date }}</td>
                <td>{{ $reservation->start_time }}</td>
                <td>{{ $reservation->end_time }}</td>
                <td>{{ $reservation->user_name }}</td>
                <td>{{ $reservation->admin_email }}</td>
                <td>{{ $reservation->phone }}</td>
                <td>{{ $reservation->admin_id }}</td>
                <td>{{ $reservation->admin_name }}</td>
                <td>{{ $reservation->user_email }}</td>
                <td>{{ $reservation->status }}</td>
                <td>
                    <form action="{{ route('reservation.markReserved', $reservation->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Reserved</button>
                    </form>
                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>