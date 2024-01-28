<div class="row">
    <div class="col-4">
        {{-- Avatar --}}
        @if ($user->avatar)
            <img src="#" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>

    {{-- User info --}}
    <div class="col-8">
        <div class="row mb-3">
            {{-- Name --}}
            <div class="col-auto">
                <h2 class="disply-6 mb-0">{{ $user->name }}</h2>
            </div>
            {{-- Edit profile --}}
            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    <form action="#" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            {{-- Posts --}}
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong> posts
                </a>
            </div>
            {{-- Followers --}}
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark">
                    <strong>0</strong> followers
                </a>
            </div>
            {{-- Following --}}
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark">
                    <strong>0</strong> following
                </a>
            </div>
        </div>
        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>