<x-layout doctitle="Edit {{$post->title}}">
    <div class="container py-md-5 container--narrow">
        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method("PUT")

            <div class="form-group">
                <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
                <input name="title" id="post-title" class="form-control form-control-lg form-control-title"
                    type="text" placeholder="" autocomplete="off" value="{{ old ('title', $post->title) }}" />

                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
                <textarea name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{ old ('body', $post->body) }}</textarea>

                @error('body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</x-layout>
