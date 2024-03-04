<div id="allusers" class="container tab-pane fade">
    <h2>Users</h2>
    <!-- Display users with UserType 0 -->
    @if ($allusers->isEmpty())
        <p>No users with UserType 0 found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($allusers as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <!-- Add more columns if needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
