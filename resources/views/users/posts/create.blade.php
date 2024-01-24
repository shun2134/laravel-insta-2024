@extends('layouts.app')

@section('title', 'Create Post')
    
@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        {{-- categories --}}
        <div class="mb-3">
            <label for="category" class="form-label d-block fw-bold">
                Category <span class="text-muted fw-normal">(up to 3)</span>
            </label>

            @foreach ($all_categories as $category)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                    <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach

            {{-- Error --}}
            @error('category')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>

        {{-- description --}}
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="What's on your mind" class="form-control">{{ old('description') }}</textarea>
            {{-- Error --}}
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- uploading image --}}
        <div class="mb-4">
            <label for="image" class="form-label fw-bold">Image</label>
            <input type="file" name="image" id="image" aria-describedby="image-info" class="form-control">
            <div id="image-info" class="form-text">
                The acceptable formats are jpeg, jpg, png, and gif only. <br>
                Max file siez is 1048KB.
            </div>
            {{-- Error --}}
            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-5">Post</button>
    </form>
@endsection