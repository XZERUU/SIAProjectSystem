<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Plant Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Plant Monitoring Report Table</h2>
    <h2> Date: {{ date('Y-m-d') }}</h2>
    <table>
        <thead>
            <tr>
                <th>Custom ID</th>
                <th>Name</th>
                <th>Plant Name</th>
                <th>Growth Stage</th>
                <th>Planting Date</th>
                <th>Temperature (°C)</th>
            </tr>
        </thead>
        <tbody>
        @foreach($plants as $plant)
            <tr>
                <td>{{ $plant->custom_id }}</td>
                <td>{{ $plant->name }}</td>
                <td>{{ $plant->plant_name }}</td>
                <td>{{ $plant->growth_stage }}</td>
                <td>{{ $plant->planting_date }}</td>
                <td>{{ $plant->temperature }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
