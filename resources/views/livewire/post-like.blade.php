<div>
    <button
        wire:click="toggleLike"
        wire:loading.attr="disabled"
        wire:target="toggleLike"
        class="focus:outline-none transition duration-300 p-2 d-flex align-items-center"
        id="like-button"
        onclick="toggleLikeInstant(this)"
        data-is-liked="{{ $isLiked }}"
        data-likes-count="{{ $likesCount }}"
    >
        <!-- Kondisi Like -->
        <span id="like-icon">
            @if ($isLiked)
                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke="none" class="w-6 h-6">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12.1 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54l-1.45 1.31z" />
                </svg>
            @endif
        </span>
        <span id="like-count" class="text-sm text-gray-600">{{ $likesCount }}</span>
    </button>
</div>
<script>    
    function toggleLikeInstant(button) {
    const isLiked = button.getAttribute('data-is-liked') === 'true';
    const likesCountElement = document.getElementById('like-count');
    const likeIconElement = document.getElementById('like-icon');
    let likesCount = parseInt(button.getAttribute('data-likes-count'));

    // Toggle Like UI
    if (isLiked) {
        button.setAttribute('data-is-liked', 'false');
        likesCount--;
        likeIconElement.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M12.1 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54l-1.45 1.31z" />
            </svg>
        `;
    } else {
        button.setAttribute('data-is-liked', 'true');
        likesCount++;
        likeIconElement.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke="none" class="w-6 h-6">
                <path
                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg>
        `;
    }

    // Update Likes Count Instantly
    likesCountElement.textContent = likesCount;
    button.setAttribute('data-likes-count', likesCount);
}

</script>