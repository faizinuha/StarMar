<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <!-- Brand Logo -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('beranda') }}" class="text-nowrap logo-img">
                <i class="ti ti-dashboard" style="font-size: 36px; color: #4F46E5;"></i>
                <span class="ms-2 fw-bold" style="font-size: 20px;">Your Brand</span>
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- Home Section -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span><i class="ti ti-home"></i></span>
                        <span class="hide-menu">Beranda</span>
                    </a>
                </li>

                <!-- Data Postingan -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('posts.index') }}" aria-expanded="false">
                        <span><i class="ti ti-package"></i></span>
                        <span class="hide-menu">Data Postingan</span>
                    </a>
                </li>

                <!-- Uploads -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index3.html" aria-expanded="false">
                        <span><i class="ti ti-upload"></i></span>
                        <span class="hide-menu">Uploads</span>
                    </a>
                </li>

                <!-- Notification Reports -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index4.html" aria-expanded="false">
                        <span><i class="ti ti-bell"></i></span>
                        <span class="hide-menu">Notification Reports</span>
                    </a>
                </li>

                <!-- Account -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('Account.index') }}" aria-expanded="false">
                        <span><i class="ti ti-user"></i></span>
                        <span class="hide-menu">Account</span>
                    </a>
                </li>

                <!-- Account Backup -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index5.html" aria-expanded="false">
                        <span><i class="ti ti-database"></i></span>
                        <span class="hide-menu">Account Backup</span>
                    </a>
                </li>

                <!-- Games -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index6.html" aria-expanded="false">
                        <span><i class="ti ti-device-gamepad"></i></span>
                        <span class="hide-menu">Games</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<!-- Include Tabler Icons -->
<link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
