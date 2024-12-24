<x-layout>
    <div class="container py-md-5 container--narrow">
        <h2>
            <img class="avatar-small" src="{{ $user->avatar }}" />
            {{ $user->username }}
            <form class="ml-2 d-inline" action="{{ route('follow.store', ['user' => $user]) }}" method="POST">
                @csrf
                @auth
                    @if (!$following && auth ()->user ()->isNot ($user))
                        <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
                    @endif

                    @if ($following)
                        @method ("delete")
                        <button class="btn btn-danger btn-sm">Unfollow <i class="fas fa-user-minus"></i></button>
                    @endif
                @endauth
                <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->

                @if (auth()->user()->is($user))
                    <a href="{{ route('manage_avatar', ['user' => $user->username]) }}"
                        class="btn btn-success btn-sm">Edit Profile</a>
                @endif
            </form>
        </h2>

        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a href="{{ route ('profile.show', [ 'user' => $user ]) }}" class="profile-nav-link nav-item nav-link {{ Request::segment (3) == '' ? 'active' : '' }}">Posts: {{ $user->posts->count() }}</a>
            <a href="{{ route ('profile.followers', [ 'user' => $user ]) }}" class="profile-nav-link nav-item nav-link {{ Request::segment (3) == 'followers' ? 'active' : '' }}">Followers: 3</a>
            <a href="{{ route ('profile.following', [ 'user' => $user ]) }}" class="profile-nav-link nav-item nav-link {{ Request::segment (3) == 'following' ? 'active' : '' }}">Following: 2</a>
        </div>

        <div class="profile-slot-content">
            {{ $slot }}
        </div>
    </div>
</x-layout>
