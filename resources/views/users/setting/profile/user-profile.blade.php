@extends('users.app')
@section('content')
    <header>
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <div class="container">

            <div class="profile">

                <div class="profile-image">

                    <img src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces"
                        alt="">

                </div>

                <div class="profile-user-settings">
                    <!-- Menampilkan Nama Pengguna -->
                    <h1 class="profile-user-name font-bold" >
                        {{ $user->first_name }}_ <!-- Ganti Auth::user() dengan $user untuk fleksibilitas -->
                    </h1>
                
                    <!-- Tampilkan tombol Edit Profile jika pengguna sedang melihat profil dirinya sendiri -->
                    @if (Auth::check() && Auth::id() === $user->id)
                        <a href="{{ route('profile.edit') }}">
                            <button class="btn profile-edit-btn">Edit Profile</button>
                        </a>
                    @endif
                
                    <!-- Tombol Settings -->
                    @if (Auth::id() === $user->id)
                        <a href="{{ route('user.setting') }}">
                            <button class="btn profile-settings-btn" aria-label="profile settings">
                                <i class="fas fa-cog" aria-hidden="true"></i>
                            </button>
                        </a>
                    @endif
                
                    <!-- Tombol Follow/Unfollow -->
                    @if (Auth::id() !== $user->id)
                        <!-- Tombol hanya muncul jika melihat profil orang lain -->
                        @if (Auth::user()->followings->contains($user->id))
                            <!-- Tombol Unfollow -->
                            <form action="{{ route('unfollow', $user) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Unfollow</button>
                            </form>
                        @else
                            <!-- Tombol Follow -->
                            <form action="{{ route('follow', $user) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Follow</button>
                            </form>
                        @endif
                    @endif
                </div>
                
                <div class="profile-stats">
                    <ul>
                        <li><span class="profile-stat-count">{{ $postCount }}</span> posts</li>
                        <li><span class="profile-stat-count">{{ $followersCount }}</span> followers</li>
                        <li><span class="profile-stat-count">{{ $followingCount }}</span> following</li>
                    </ul>
                </div>
                <div class="profile-bio">

                    <p><span class="profile-real-name">Jane Doe</span> Lorem ipsum dolor sit, amet consectetur adipisicing
                        elit 📷✈️🏕️</p>
                        <p>Bergabung sejak: {{ $user->created_at->format('d M Y') }}</p>

                </div>

            </div>
            <!-- End of profile section -->

        </div>
        <!-- End of container -->

    </header>

    <main>

        <div class="container">

            <div class="gallery">
                @forelse ($pos as $p)
                <div class="gallery-item" tabindex="0">

                    <img src="{{asset('storage/'. $p->image)}}"
                        class="gallery-image" alt="">

                    <div class="gallery-item-info">

                        <ul>
                            <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i
                                    class="fas fa-heart" aria-hidden="true"></i> 56</li>
                            <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                    class="fas fa-comment" aria-hidden="true"></i> 2</li>
                        </ul>

                    </div>

                </div>
                @empty
                    
                @endforelse
                <div class="gallery-item" tabindex="0">

                    <img src="https://images.unsplash.com/photo-1511765224389-37f0e77cf0eb?w=500&h=500&fit=crop"
                        class="gallery-image" alt="">

                    <div class="gallery-item-info">

                        <ul>
                            <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i
                                    class="fas fa-heart" aria-hidden="true"></i> 56</li>
                            <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                    class="fas fa-comment" aria-hidden="true"></i> 2</li>
                        </ul>

                    </div>

                </div>

                <div class="gallery-item" tabindex="0">

                    <img src="https://images.unsplash.com/photo-1497445462247-4330a224fdb1?w=500&h=500&fit=crop"
                        class="gallery-image" alt="">

                    <div class="gallery-item-info">

                        <ul>
                            <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i
                                    class="fas fa-heart" aria-hidden="true"></i> 89</li>
                            <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                    class="fas fa-comment" aria-hidden="true"></i> 5</li>
                        </ul>

                    </div>

                </div>

                <div class="gallery-item" tabindex="0">

                    <img src="https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=500&h=500&fit=crop"
                        class="gallery-image" alt="">

                    <div class="gallery-item-type">

                        <span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

                    </div>

                    <div class="gallery-item-info">

                        <ul>
                            <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i
                                    class="fas fa-heart" aria-hidden="true"></i> 42</li>
                            <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                    class="fas fa-comment" aria-hidden="true"></i> 1</li>
                        </ul>

                    </div>

                </div>
            </div>
        <!-- End of gallery -->

            <div class="loader"></div>

        </div>
        <!-- End of container -->

    </main>
    <style>

    </style>
@endsection
