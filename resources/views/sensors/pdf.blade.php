<!DOCTYPE html>
<html>
<head>
    <title>Sensors Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f3f3f3; }
    </style>
</head>
<body>
    <h2>Sensors Report</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Sensor Type</th>
                <th>Temperature (°C)</th>
                <th>Water Level</th>
                <th>Plant Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sensors as $sensor)
                <tr>
                    <td>{{ $sensor->id }}</td>
                    <td>{{ $sensor->sensor_type }}</td>
                    <td>{{ number_format($sensor->temperature, 2) }}°C</td>
                    <td>{{ number_format($sensor->water_level, 2) }}</td>
                    <td>{{ $sensor->plant->plant_name ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
