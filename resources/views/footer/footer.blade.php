<!-- Footer -->
<div class="app-footer border-0 shadow-lg bg-primary-gradiant">
    <a href="default.html" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
    <a href="default-video.html" class="nav-content-bttn"><i class="feather-package"></i></a>
    <a href="default-live-stream.html" class="nav-content-bttn" data-tab="chats"><i class="feather-layout"></i></a>
    <a href="shop-2.html" class="nav-content-bttn"><i class="feather-layers"></i></a>

    <!-- New "Add Post" Button -->
    <a href="javascript:void(0);" class="nav-content-bttn post-button">
      <i class="feather-package"></i><!-- Plus icon for adding posts -->
    </a>

    <!-- User Profile -->
    <a href="default-settings.html" class="nav-content-bttn">
        <img src="images/female-profile.png" alt="user" class="w30 shadow-xss">
    </a>
</div>
<script>
    document.querySelector('.post-button').addEventListener('click', function() {
        // You can redirect to a specific post creation page, or show a modal
        window.location.href = 'posts/create'; // Change '/create-post' to your post creation route.
    });
</script>
