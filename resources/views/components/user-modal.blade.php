<!-- resources/views/components/user-modal.blade.php -->
<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden"></div>

<div id="userModal" class="fixed inset-0 flex items-end justify-center p-4 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md m-auto z-10 p-6">
        <h2 class="text-xl font-bold mb-4">Add New User</h2>
        <form action="{{ route('player_store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="mb-6">
                <label for="tagline" class="block text-sm font-medium text-gray-700">Tagline</label>
                <input type="text" name="tagline" id="tagline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="flex items-center justify-between">
                <x-primary-button>
                    Save User
                </x-primary-button>
                <x-primary-button type="button" class="bg-gray-300 hover:bg-gray-400 active:bg-gray-500" onclick="document.getElementById('userModal').classList.add('hidden'); document.getElementById('modalOverlay').classList.add('hidden');">
                    Close
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
