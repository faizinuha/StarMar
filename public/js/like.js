
            document.addEventListener('DOMContentLoaded', function() {
                const likeButtons = document.querySelectorAll('.like-button');

                likeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const postId = this.dataset.postId;
                        const likeCountElement = this
                            .nextElementSibling; // Ambil elemen setelah tombol (jumlah like)

                        fetch('/like', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    post_id: postId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'liked') {
                                    this.classList.add('liked');
                                } else if (data.status === 'unliked') {
                                    this.classList.remove('liked');
                                }
                                // Update jumlah like
                                likeCountElement.textContent = data.like_count;
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });
            });
  