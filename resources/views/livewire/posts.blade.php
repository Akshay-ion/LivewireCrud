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
        <button class="btn btn-primary" wire:click="addPost()">Create Post</button>
    @endif
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
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Post Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
