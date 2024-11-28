
    $(document).ready(function() {
        // Event delegation untuk tombol Reply
        $(document).on('click', '.reply-btn', function() {
            const commentId = $(this).data('comment-id');
            const form = $(this).closest('.comment').find(
                `.reply-form[data-comment-id="${commentId}"]`);
            form.toggleClass('hidden');
            form.find('textarea').focus();
            form.find('input[name="parent_id"]').val(commentId); // Menyimpan ID komentar induk
        });

        // Mengirim komentar utama dengan AJAX
        $(document).on('submit', '.comment-form', function(e) {
            e.preventDefault();

            const form = $(this);
            const postId = form.data('post-id');
            const content = form.find('textarea[name="content"]').val();
            const token = form.find('input[name="_token"]').val();

            if (!content) {
                alert('Content is required!');
                return;
            }

            $.ajax({
                url: '/comments',
                type: 'POST',
                data: {
                    _token: token,
                    post_id: postId,
                    content: content,
                    parent_id: '',
                },
                success: function(response) {
                    form.find('textarea[name="content"]').val('');
                    const newCommentHTML = `
            <div class="comment" id="comment-${response.id}">
                <div class="flex space-x-4">
                    <div class="w-8 h-8 bg-blue-200 rounded-full flex items-center justify-center text-white font-semibold">
                        ${response.user.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <h5 class="font-semibold text-gray-800">${response.user}</h5>
                        <p class="text-sm text-gray-500">${response.created_at}</p>
                        <p class="text-gray-800">${response.content}</p>
                        <button class="reply-btn bg-gray-200 text-gray-800 px-4 py-2 mt-2 rounded-lg" data-comment-id="${response.id}">Reply</button>
                        <div class="replies"></div>
                    </div>
                </div>
            </div>
        `;
                    location.reload();
                    form.closest('.p-4').find('.comments').prepend(newCommentHTML);
                },
                error: function(error) {
                    alert('Error: ' + error.responseJSON.message);
                },
            });

        });

        // Mengirim balasan dengan AJAX
        $(document).on('submit', '.reply-form', function(e) {
            e.preventDefault();

            const form = $(this);
            const postId = form.find('input[name="post_id"]').val();
            const parentId = form.find('input[name="parent_id"]').val();
            const content = form.find('textarea[name="content"]').val();
            const token = form.find('input[name="_token"]').val();

            if (!content) {
                alert('Content is required!');
                return;
            }

            $.ajax({
                url: '/comments',
                type: 'POST',
                data: {
                    _token: token,
                    post_id: postId,
                    parent_id: parentId,
                    content: content,
                },
                success: function(response) {
                    form.find('textarea[name="content"]').val('');
                    form.addClass('hidden');
                    const newReplyHTML = `
            <div class="flex space-x-4">
                <div class="w-8 h-8 bg-green-200 rounded-full flex items-center justify-center text-white font-semibold">
                    ${response.user.charAt(0).toUpperCase()}
                </div>
                <div>
                    <h5 class="font-semibold text-gray-800">${response.user}</h5>
                    <p class="text-sm text-gray-500">${response.created_at}</p>
                    <p class="text-gray-800">${response.content}</p>
                </div>
            </div>
        `;
                    $(`#comment-${parentId} .replies`).prepend(newReplyHTML);
                },
                error: function(error) {
                    alert('Error: ' + error.responseJSON.message);
                },
            });
        });
    });
