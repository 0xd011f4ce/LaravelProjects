<x-profile_layout :user="$user" :following="$following">
    <div class="list-group">
        @foreach ($user->followers as $follower)
            <a href="{{ route('profile.show', ['user' => $follower->source]) }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ $follower->source->avatar }}" />
                <strong>{{ $follower->source->username }}</strong>
            </a>
        @endforeach
    </div>
</x-profile>

