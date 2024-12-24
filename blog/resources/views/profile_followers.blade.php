<x-profile_layout :user="$user" :following="$following">
    <div class="list-group">
        @foreach ($user->posts()->latest()->get() as $post)
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ $user->avatar }}" />
                <strong>{{ $post->title }}</strong> on {{ $post->created_at->format('d/m/Y') }}
            </a>
        @endforeach
    </div>
</x-profile>

