<div>
    <button wire:click="toggleFollow"
        class="{{ $isFollowing ? 'bg-red-500' : 'bg-green-400' }} px-3 py-2 " style="border-radius:25px">
        {{ $isFollowing ? 'Unfollow' : 'Follow' }}
    </button>
</div>
