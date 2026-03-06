<div class="card mb-2">
    <div class="card-header">
        Edit Post
    </div>
    <form wire:submit="updatePost()">
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error("title") is-invalid @enderror" wire:model="title">
                @error("title")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="body" class="form-label">Body</label>
                <textarea class="form-control @error("title") is-invalid @enderror" wire:model="body"></textarea>
                @error("body")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-success">Update</button>
            <button type="button" class="btn btn-secondary mx-2" wire:click="closeEdit()">Cancel</button>
        </div>
    </form>
</div>
