<!-- Footer -->
<div class="app-footer border-0 shadow-lg bg-primary-gradiant">
    <!-- Home -->
    <a href="default.html" class="nav-content-bttn nav-center">
        <i class="feather-home"></i>
    </a>

    <!-- Videos -->
    <a href="default-video.html" class="nav-content-bttn">
        <i class="feather-package"></i>
    </a>

    <!-- Live Stream -->
    <a href="default-live-stream.html" class="nav-content-bttn" data-tab="chats">
        <i class="feather-layout"></i>
    </a>

    <!-- Shop -->
    <a href="shop-2.html" class="nav-content-bttn">
        <i class="feather-layers"></i>
    </a>

    <!-- Add Post Button -->
    <a href="javascript:void(0);" class="nav-content-bttn post-button">
        <i class="feather-plus-circle"></i> <!-- Plus icon for adding posts -->
    </a>

    <!-- User Profile -->
    @php
        $photoPath = $user->photo_profile ?? null; // Path foto profil
        $photoExists = $photoPath && file_exists(public_path('storage/' . $photoPath)); // Cek file
    @endphp
    <a href="{{route('user.setting')}}" class="nav-content-bttn">
        @if ($photoExists)
            <img src="{{ asset('storage/' . $photoPath) }}" alt="Profile Picture" class="w30 shadow-xss">
        @else
            <img src="{{ asset('users/avatar.png') }}" alt="Default Avatar" class="w30 shadow-xss">
        @endif
    </a>
</div>

<!-- Script for Add Post Button -->
<script>
    document.querySelector('.post-button').addEventListener('click', function() {
        // Redirect to the post creation page or trigger a modal
        window.location.href = '/posts/create'; // Replace with your post creation route
    });
</script>
