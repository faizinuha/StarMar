
document.addEventListener('DOMContentLoaded', () => {
    const readMoreButtons = document.querySelectorAll('.read-more');

    readMoreButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const parent = event.target.parentElement;
            const shortContent = parent.querySelector('.short-content');
            const longContent = parent.querySelector('.long-content');

            // Tampilkan konten penuh
            shortContent.classList.toggle('hidden');
            longContent.classList.toggle('hidden');

            // Ubah teks tombol
            if (longContent.classList.contains('hidden')) {
                button.textContent = 'Read More';
            } else {
                button.textContent = 'Read Less';
            }
        });
    });
});

function confirmDelete(postId) {
    if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
        document.getElementById('delete-form-' + postId).submit();
    }
}

function openShareModal(postId) {
    document.getElementById('shareModal').classList.remove('hidden');
    // Simpan ID post untuk digunakan saat generate link
    window.currentPostId = postId;
}

function closeShareModal() {
    document.getElementById('shareModal').classList.add('hidden');
}

function generateLink(platform) {
    const postId = window.currentPostId;
    let url = '';

    // Logika untuk mengenerate link sesuai platform
    switch (platform) {
        case 'instagram':
            url = `https://www.instagram.com/?url={{ url('posts') }}/${postId}`;
            break;
        case 'facebook':
            url = `https://www.facebook.com/sharer/sharer.php?u={{ url('posts') }}/${postId}`;
            break;
        case 'twitter':
            url = `https://twitter.com/intent/tweet?url={{ url('posts') }}/${postId}`;
            break;
        case 'whatsapp':
            url = `https://wa.me/?text={{ url('posts') }}/${postId}`;
            break;
        default:
            url = `https://www.example.com/${postId}`;
    }

    // Tampilkan URL di dalam modal
    document.getElementById('shareLink').textContent = `Link berbagi: ${url}`;
}
