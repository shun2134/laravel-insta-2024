<div class="row">
    <div class="col-4">
        {{-- Avatar --}}
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
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
            
            {{-- Button --}}
            <div class="col-auto p-1">
                {{-- Edit profile --}}
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    @if ($user->isFollowed())
                        {{-- Unfollow user --}}
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                        </form>
                    @else
                        {{-- Follow user --}}
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>

        <div class="row mb-3">
            {{-- Posts --}}
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    {{-- condition ? true statement : false statement --}}
                    <strong>{{ $user->posts->count() }}</strong> {{ $user->posts->count() == 1 ? 'post' : 'posts' }}
                </a>
            </div>
            {{-- Followers --}}
            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count() == 1 ? 'follower' : 'followers' }}
                </a>
            </div>
            {{-- Following --}}
            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->following->count() }}</strong> following
                </a>
            </div>
        </div>
        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>