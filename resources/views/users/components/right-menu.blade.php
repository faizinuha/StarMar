@php
    // Ambil semua pengguna kecuali diri sendiri
    $users = App\Models\User::where('id', '!=', Auth::id())->get();
    $currentUser = Auth::user();
@endphp
<div class="col-xl-4 col-xxl-3 col-lg-4 ps-lg-0">
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-flex align-items-center p-4">
            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Friend Request</h4>
            <a href="default-member.html" class="fw-600 ms-auto font-xssss text-primary">See all</a>
        </div>

        {{-- Tampilkan Diri Sendiri di Baris Pertama --}}
        <div class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0 align-items-center">
            <figure class="avatar me-3">
                <img src="{{ $currentUser->photo_profile ? asset('storage/' . $currentUser->photo_profile) : asset('users/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg') }}"
                    alt="image" class="shadow-sm rounded-circle w45">
            </figure>
            <h4 class="fw-700 text-grey-900 font-xssss mt-1 d-flex align-items-center">
                {{ $currentUser->first_name }} <span class="text-grey-500 ms-2">(You)</span>
            </h4>
        </div>

        {{-- Tampilkan Daftar Teman --}}
        @foreach ($users as $user)
            <div class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0 align-items-center">
                <figure class="avatar me-3">
                    {{-- <img src="{{ asset('storage/' . $users ) }}"
                        alt="image" class="shadow-sm rounded-circle w45"> --}}
                        <div
                                                class="custom-circle bg-info text-white rounded-circle d-flex align-items-center justify-content-center font-weight-bold">
                                                {{ strtoupper(substr($post->user->first_name, 0, 1)) }}
                                            </div>
                </figure>
                <div>
                    <h4 class="fw-700 text-grey-900 font-xssss mt-1 d-flex align-items-center">
                        {{ $user->first_name }}
                    </h4>
                    {{-- Tambahkan Jumlah Mutual Friends --}}
                    <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual friends</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">

                <livewire:follows :user="$user" />

            </div>
        @endforeach
    </div>
</div>
