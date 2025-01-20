@php
    // Ambil pengguna yang sedang login
    $currentUser = Auth::user();

    // Ambil semua pengguna kecuali diri sendiri
    $users = App\Models\User::where('id', '!=', Auth::id())->get();
@endphp

<div class="col-xl-4 col-xxl-3 col-lg-4 ps-lg-0">
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-flex align-items-center p-4">
            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Friend Request</h4>
            <a href="default-member.html" class="fw-600 ms-auto font-xssss text-primary">See all</a>
        </div>

        {{-- Bagian "You" --}}
        <div class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0 align-items-center mb-2">
            <figure class="avatar me-3">
                @if (!empty($currentUser->photo_profile) && file_exists(public_path('storage/' . $currentUser->photo_profile)))
                    <img src="{{ asset('storage/' . $currentUser->photo_profile) }}" alt="Profile Picture"
                        class="shadow-sm rounded-circle w50">
                @else
                    <img src="{{ asset('users/avatar.png') }}" alt="Default Avatar"
                        class="shadow-sm rounded-circle w50">
                @endif
            </figure>
           <a href="{{ route('user.profile', $currentUser->id) }}"><h4 class="fw-700 text-grey-900 font-xssss mt-1 d-flex align-items-center">
            {{ $currentUser->first_name }} <span class="text-grey-500 ms-2">(You)</span>
        </h4></a>
        </div>

        {{-- Bagian "All Friends" --}}
        @forelse ($users as $user)
            @php
                $photoPath = $user->photo_profile; // Path foto profil
                $photoExists = $photoPath && file_exists(public_path('storage/' . $photoPath)); // Cek file
            @endphp

            <div class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0 align-items-center">
                <figure class="avatar me-3">
                    @if ($photoExists)
                        <img src="{{ asset('storage/' . $photoPath) }}" alt="Friend's Profile Picture"
                            class="shadow-sm rounded-circle w50">
                    @else
                        <img src="{{ asset('users/avatar.png') }}" alt="Default Avatar"
                            class="shadow-sm rounded-circle w50">
                    @endif
                </figure>
                <div>
                    <a href="{{ route('user.profile', $user->id) }}"><h4 class="fw-700 text-grey-900 font-xssss mt-1 d-flex align-items-center">
                        {{ $user->first_name }}
                    </h4></a>
                    {{-- Tambahkan informasi mutual friends --}}
                    <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual friends</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4 mt-2">
                <livewire:follows :user="$user" />
            </div>
        @empty
            <div class="card-body d-flex align-items-center pt-4 ps-4 pe-4 pb-4">
                <p class="text-grey-500">No friends to show.</p>
            </div>
        @endforelse
    </div>
</div>
