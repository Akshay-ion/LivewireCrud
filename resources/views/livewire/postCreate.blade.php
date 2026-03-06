<div class="card mb-2">
    <div class="card-header">
        Create Post
    </div>
    <form wire:submit="storePost()">
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
            <button class="btn btn-success">Save</button>
            <button class="btn btn-secondary mx-2" wire:click="closePost()">Cancel</button>
        </div>
    </form>
</div>
