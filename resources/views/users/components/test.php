@extends('users.app')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <header>
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <div class="container">

            <div class="profile">

                <div class="profile-image text-center position-relative">
                    <img 
                        src="{{ asset('storage/' . $profilePhoto) }}"
                        alt="Foto Profil" 
                        class="rounded-circle mt-2" 
                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
                    >
                    
                    <div class="position-absolute bottom-0 end-0 p-1">
                        <label for="photo" class="btn btn-primary btn-sm rounded-circle">
                            <i class="bi bi-pencil-fill"></i>
                        </label>
                    </div>
                    
                    <form action="{{ route('profile.update_picture') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="photo" id="photo" accept="image/*" capture="camera" class="form-control" style="display: none;" onchange="this.form.submit()">
                    </form>
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
            <!-- Bagian Story -->
            {{-- <div class="story-container">
                <div class="story">
                    <img src="path/to/image1.jpg" class="story-image" alt="Story">
                    <p>JavalDe</p>
                </div>
                <div class="story">
                    <img src="path/to/image2.jpg" class="story-image" alt="Story">
                    <p>Anime Terpisah</p>
                </div>
                <div class="story">
                    <img src="path/to/image3.jpg" class="story-image" alt="Story">
                    <p>Gambar Cute</p>
                </div>
                <div class="story">
                    <img src="path/to/image4.jpg" class="story-image" alt="Story">
                    <p>Nyaman</p>
                </div>
                <div class="story add-story">
                    <i class="fas fa-plus"></i>
                    <p>New</p>
                </div>
            </div> --}}
    
            <!-- Bagian Navigasi -->
            <div class="profile-nav">
                <a href="#">Posts</a>
                <a href="#">Reels</a>
                <a href="#">Saved</a>
                <a href="#">Tagged</a>
            </div>
    
            <!-- Bagian Gallery -->
            <div class="gallery">
                @forelse ($pos as $p)
                    <div class="gallery-item-info" tabindex="0">
                        <img src="{{asset('storage/'. $p->image)}}" class="gallery-image" alt="">
                        <div class="gallery-item-info">
                            <ul>
                                <li><i class="fas fa-heart"></i> 56</li>
                                <li><i class="fas fa-comment"></i> 2</li>
                            </ul>
                        </div>
                    </div>
                @empty
                    <p>No posts available</p>
                @endforelse
            </div>
        </div>
    </main>
    
    <style>
/* Container Utama */
.container {
    width: 80%;
    margin: auto;
}


/* Navigasi */
.profile-nav {
    display: flex;
    justify-content: space-evenly;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}

.profile-nav a {
    text-decoration: none;
    color: #333;
    padding: 10px;
    font-weight: bold;
}

.profile-nav a:hover {
    color: #d6249f;
}

/* Gallery */
.gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

.gallery-item {
    position: relative;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


    </style>
@endsection
