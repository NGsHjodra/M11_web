<x-site-layout title="Player">
    <div class="container">
        <h1>Matches for Player: {{ $user->name ?? 'Unknown Player' }}</h1>
        <ul>
            @forelse ($matches as $match)
                <li>Match ID: {{ $match->match_id }}, Placement: {{ $match->placement }}</li>
            @empty
                <p>No matches found.</p>
            @endforelse
            {{-- some space --}}
            <br>
            {{-- some space --}}
            <a href="{{ route('player_fetch_matches', $user->puuid) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">Update Match History</a>

        </ul>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</x-site-layout>
