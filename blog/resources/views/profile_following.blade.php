<x-profile_layout :user="$user" :following="$following">
    <div class="list-group">
        @foreach ($user->following as $following)
            <a href="{{ route('profile.show', ['user' => $following->target]) }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ $following->target->avatar }}" />
                <strong>{{ $following->target->username }}</strong>
            </a>
        @endforeach
    </div>
</x-profile>
