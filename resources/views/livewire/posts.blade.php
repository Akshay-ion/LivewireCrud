<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    @session("success")
    <div class="alert alert-success">
        {{ $value }}
    </div>
    @endsession
    @if($postForm)
        @include('livewire.postCreate')
    @else
        <button class="btn btn-primary m-2" wire:click="addPost()">Create Post</button>
    @endif

    @if ($editForm)
        @include('livewire.postEdit')
    @endif

    <div class="mt-3">
        <input type="text" class="form-control" name="search" wire:model.live="search" placeholder="Search Post">
    </div>
    <div
        class="table-responsive mt-3"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody wire:key="posts-list-{{ count($posts) }}">
                @forelse ($posts as $post)
                    <tr wire:key="post-{{ $post->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" wire:click="editPost({{$post->id}})">Edit</button>
                            <button class="btn btn-danger btn-sm mx-1" wire:confirm="Are you sure delete this post?" wire:click="deletePost({{$post->id}})">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Post Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>

</div>
