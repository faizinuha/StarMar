<div>
    <button wire:click="toggleFollow"
        class="{{ $isFollowing ? 'bg-gray-400 text-white' : 'bg-blue-500 text-white' }} px-3 py-2 rounded-5">
        {{ $isFollowing ? 'Unfollow' : 'Follow' }}
    </button>
</div>
