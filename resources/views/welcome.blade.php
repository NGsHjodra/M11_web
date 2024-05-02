<x-site-layout title="Leaderboard">
    <div class="container mx-auto text-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Summoner</th>
                    <th>Tier and Division</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $player)
                    <tr>
                        <td>
                            <a href="{{ route('player_show', $player->puuid) }}">
                                {{ $player->name."#".$player->tagline}}
                            </a>
                        </td>
                        <td>{{ $player->tier }} {{ $player->rank }}</td>
                        <td>{{ $player->point }}</td>
                    </tr>
                @endforeach

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </tbody>
        </table>
    </div>
    <button id="openModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
        Add User
    </button>
</x-site-layout>

@include('components.user-modal')

<script>
    const openModal = document.getElementById('openModal');
    const modal = document.getElementById('userModal');
    const overlay = document.getElementById('modalOverlay');

    openModal.addEventListener('click', function () {
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    });

    overlay.addEventListener('click', function () {
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
    });
</script>