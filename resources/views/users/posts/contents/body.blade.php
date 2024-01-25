{{-- clickable image --}}
<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
    </a>
</div>

{{-- card-body --}}
<div class="card-body">
    {{-- heart button + No. likes + categories --}}
    <div class="row align-items-cneter">
        {{-- heart button --}}
        <div class="col-auto">
            <form action="#" method="post">
                @csrf
                <button type="submit" class="btn btn-sm shadow-none p-0">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>
        </div>

        {{-- No. likes --}}
        <div class="col-auto px-0">
            <span>3</span>
        </div>

        {{-- categories --}}
        <div class="col text-end">
            @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50">
                    {{ $category_post->category->name }}
                </div>
            @endforeach
        </div>

        {{-- owner + description --}}
        <a href="#" class="text-decoration-none text-dark fw-bold">
            {{ $post->user->name }}
        </a>
        &nbsp;
        <p class="d-inline fw-light">{{ $post->description }}</p>
        <p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>

        {{-- Include comment form here --}}

    </div>
</div>