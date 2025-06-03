<!DOCTYPE html>
<html>
<head>
    <title>Transactions Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f3f3f3; }
    </style>
</head>
<body>
    <h2>Transactions Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Sensor ID</th>
                <th>Sensor Type</th>
                <th>Status</th>
                <th>Logged At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->sensor_id }}</td>
                <td>{{ $transaction->sensor->sensor_type ?? 'N/A' }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->logged_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
