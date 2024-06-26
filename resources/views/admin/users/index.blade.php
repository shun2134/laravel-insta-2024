@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')
    @auth
        {{-- This will not show up in the admin side --}}
        @if (request()->is('admin/*'))
            {{-- <div > --}}
                <form action="{{ route('admin.users.search') }}" class="ms-auto mb-3" style="width: 300px">
                    <input type="search" name="search" placeholder="Search..." class="form-control form-control-sm">
                </form>
            {{-- </div> --}}
        @endif
    @endauth

    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_users as $user)
                <tr>
                    {{-- avatar --}}
                    <td>
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="" class="rounded-circle d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                        @endif
                    </td>
                    {{-- name --}}
                    <td>
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $user->name }}
                        </a>
                    </td>
                    {{-- email --}}
                    <td>{{ $user->email }}</td>
                    {{-- created_at --}}
                    <td>{{ date('M d, Y', strtotime($user->created_at)) }}</td>
                    {{-- active --}}
                    <td>
                        {{-- $user->trashed() returns TRUE if the user was soft deleted. --}}
                        @if ($user->trashed())
                            <i class="fa-regular fa-circle text-secondary"></i>&nbsp; Inactive
                        @else
                            <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
                        @endif
                    </td>
                    <td>
                        @if ($user->id !== Auth::user()->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                <div class="dropdown-menu">
                                    @if ($user->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-check"></i> Activate {{ $user->name }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->name }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                            {{-- Include the Deactivate User Modal here --}}
                            @include('admin.users.modal.status')

                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $all_users->links() }}
@endsection