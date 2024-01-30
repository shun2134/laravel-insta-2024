@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
            {{-- POSTS --}}
        <div class="col-8">
            @forelse ($all_posts as $post)
                <div class="card mb-4">
                    {{-- Title --}}
                    @include('users.posts.contents.title')

                    {{-- Body --}}
                    @include('users.posts.contents.body')

                </div>
            @empty
                {{-- If the site doesn't have any post yet. --}}
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-muted">When you share photos, they'll appear on your profile</p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">
                        Share your first photo
                    </a>
                </div>
            @endforelse
        </div>
        
        {{-- PROFILE OVERVIEW + SUGGESTIONS --}}
        <div class="col-4">
            {{-- PROFILE OVERVIEW --}}
            <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
                {{-- avatar --}}
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif
                    </a>
                </div>

                {{-- name & email --}}
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

    
    </div>
@endsection
