<x-site-layout title="Player">
    <div class="container">
        <h1>Matches for Player: {{ $user->name ?? 'Unknown Player' }}</h1>
        <ul>
            @forelse ($matches as $match)
                <li>Match ID: {{ $match->match_id }}, Placement: {{ $match->placement }}</li>
            @empty
                <p>No matches found.</p>
            @endforelse
        </ul>
    </div>
</x-site-layout>
