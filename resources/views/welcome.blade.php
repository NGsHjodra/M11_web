<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Leaderboard</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Summoner</th>
                    <th>Tier and Division</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaders as $leader)
                    <tr>
                        <td>{{ $leader->name }}#{{ $leader->tagline }}</td>
                        <td>{{ $leader->tier }} {{ $leader->rank }}</td>
                        <td>{{ $leader->point }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
