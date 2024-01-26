<div class="card-header bg-white py-3">
    <div class="row align-items-center">
        {{-- avatar --}}
        <div class="col-auto">
            @if ($post->user->avatar)
                <img src="#" alt="{{ $post->user->name }}" class="rounded-circle avatar-sm">
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
            @endif
        </div>
        {{-- name --}}
        <div class="col ps-0">
            <a href="#" class="text-decoration-none text-dark">
                {{ $post->user->name }}
            </a>
        </div>

        {{-- button --}}
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                {{-- If you are the owner of the post, you can edit or delete this post --}}
                @if ($post->user_id === Auth::user()->id )
                    <div class="dropdown-menu">
                        {{-- Edit --}}
                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>

                        {{-- Delete --}}
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $post->id }}">
                            <i class="fa-regular fa-trash-can"></i> Delete
                        </button>
                    </div>

                    {{-- Include Delete Post Modal here --}}
                    @include('users.posts.contents.modals.delete')
                @else
                    {{-- If you are not the owner of the post, show an unfollow button. To be discussed soon --}}
                    <div class="dropdown-menu">
                        <form action="#" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>