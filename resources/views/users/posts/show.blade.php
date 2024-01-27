@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
    <div class="row border shadow">
        {{-- image --}}
        <div class="col p-0 border-end">
            <img src="{{ $post->image }}" alt="post id{{ $post->id }}" class="w-100">
        </div>

        {{-- post details --}}
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                {{-- header --}}
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        {{-- avatar --}}
                        <div class="col-auto">
                            <a href="#">
                                @if ($post->user->avatar)
                                    <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>

                        {{-- name --}}
                        <div class="col ps-0">
                            <a href="#" class="text-decoration-none text-dark">
                                {{ $post->user->name }}
                            </a>
                        </div>

                        {{-- button --}}
                        <div class="col-auto">
                            {{-- IF you are the owner of the post, you can edit or delete --}}
                            @if ($post->user_id === Auth::user()->id)
                                <div class="dropdown">
                                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>

                                    <div class="dropdown-menu">
                                        {{-- edit --}}
                                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>

                                        {{-- delete --}}
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $post->id }}">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </button>
                                    </div>
                                    {{-- Include Delete Post Modal --}}
                                    @include('users.posts.contents.modals.delete')
                                </div>
                            @else
                                {{-- If you are not the owner of the post, show follow/unfollow button --}}
                                {{-- Show follow button for now --}}
                                <form action="#" method="post">
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent p-0 text-primary">
                                        Follow
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- body --}}
                <div class="card-body w-100 bg-white">
                    {{-- heart button + No. likes + categories --}}
                    <div class="row align-items-center">
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
                    </div> 
                    
                        {{-- owner + description --}}
                        <a href="#" class="text-decoration-none text-dark fw-bold">
                            {{ $post->user->name }}
                        </a>
                        &nbsp;
                        <p class="d-inline fw-light">{{ $post->description }}</p>
                        <p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>
                
                        {{-- comment form here --}}
                        <div class="mt-4">
                            <form action="{{ route('comment.store', $post->id) }}" method="post">
                                @csrf
                        
                                <div class="input-group">
                                    <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm bg-white" placeholder="Add a comment...">{{ old('comment_body' . $post->id) }}</textarea>
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                                </div>
                                {{-- Error --}}
                                @error('comment_body' . $post->id)
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror              
                            </form>        
                            {{-- Show all comments here --}}
                            @if ($post->comment->isNotEmpty())
                                
                            @endif
                            
                        </div>
                </div>    

            </div>
        </div>
    </div>
@endsection