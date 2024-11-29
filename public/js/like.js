document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.like-button');

    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.dataset.postId;
            const likeCountElement = this.querySelector('.like-count'); // Get the like count element within the button
            const isLiked = this.classList.contains('liked'); // Check if the post is liked

            fetch('/like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    post_id: postId,
                    action: isLiked ? 'unlike' : 'like' // Toggle action based on the current state
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'liked') {
                    this.classList.add('liked');
                } else if (data.status === 'unliked') {
                    this.classList.remove('liked');
                }
                // Update the like count
                likeCountElement.textContent = `${data.like_count} Like`;
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
