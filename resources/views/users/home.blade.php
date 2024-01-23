@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
            {{-- POSTS --}}
        <div class="col-8 bg-warning">
            POSTS
        </div>
        
        {{-- PROFILE OVERVIEW + SUGGESTIONS --}}
        <div class="col-4 bg-secondary">
            PROFILE OVERVIEW + SUGGESTIONS
        </div>
    </div>
@endsection
