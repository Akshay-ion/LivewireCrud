<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    @session("success")
    <div class="alert alert-success text-center">
        {{ $value }}
    </div>
    @endsession
    @session("error")
    <div class="alert alert-warning text-center">
        {{ $value }}
    </div>
    @endsession
    @if($postForm)
        @include('livewire.postCreate')
    @else
        <button class="btn btn-primary m-2" wire:click="addPost()">Create Post</button>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Create post modal
        </button>

        <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Create Post</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit="storePost()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error("title") is-invalid @enderror" wire:model="title">
                                @error("title")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="body" class="form-label">Body</label>
                                <textarea class="form-control @error("body") is-invalid @enderror" wire:model="body"></textarea>
                                @error("body")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

<script type="text/javascript">
    document.addEventListener('livewire:init', () => {
        Livewire.on('close-modal', (event) => {
            const modalElement = document.getElementById('createModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    });
</script>
