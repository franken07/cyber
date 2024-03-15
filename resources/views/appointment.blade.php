<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Appointments</h1>
    @foreach($appointments as $adminName => $adminAppointments)
        <h2>{{ $adminName }}</h2>
        <p>Email: {{ $adminAppointments[0]->email }}</p>
        <p>Phone: {{ $adminAppointments[0]->phone }}</p>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Reserved</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($adminAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->start_time }}</td>
                        <td>{{ $appointment->end_time }}</td>
                        <td>
                            <form action="{{ route('reservation', ['id' => $appointment->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="button">Reserve</button>
                            </form>
                        </td>
                        <!-- Add more cells if needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
