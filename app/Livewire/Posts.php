<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    public $title, $body, $postForm = false, $editForm=false, $postId, $search;

    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::query()
                ->where(function ($query) {
                    $query->where('title', 'like', "%{$this->search}%")
                        ->orWhere('body', 'like', "%{$this->search}%");
                })
                ->latest()
                ->paginate(10)
        ]);
    }

    public function addPost(){
        $this->editForm = false;
        $this->postForm = true;
    }

    public function closePost(){
        $this->postForm = false;
    }

    public function resetFields(){
        $this->title = "";
        $this->body = "";
        $this->postId = null;
    }

    public function storePost(){
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);


        Post::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'body' => $this->body,
        ]);

        session()->flash('success', "Post Created Successfully");
        $this->resetFields();
        $this->postForm = false;

        $this->dispatch('close-modal');
    }

    public function closeEdit(){
        $this->editForm = false;
    }

    public function editPost($id){
        $post = Post::find($id);

        if($post->user_id != Auth::id()){
            session()->flash('error', 'Unauthenticated');
            $this->resetFields();
            $this->closeEdit();
            return;
        }

        $this->title = $post->title;
        $this->body = $post->body;
        $this->postId = $post->id;
        $this->postForm = false;
        $this->editForm = true;
    }

    public function editPostModal($id){
        $post = Post::find($id);

        if($post->user_id != Auth::id()){
            session()->flash('error', 'Unauthenticated');
            $this->resetFields();
            $this->closeEdit();
            return;
        }

        $this->title = $post->title;
        $this->body = $post->body;
        $this->postId = $post->id;
        $this->postForm = false;
        $this->dispatch('open-edit-modal');
    }

    public function updatePost(){
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::find($this->postId);

        if($post->user_id != Auth::id()){
            session()->flash('error', 'Unauthenticated');
            $this->resetFields();
            $this->closeEdit();
            return;
        }

        $post->update([
            'title' => $this->title,
            'body' => $this->body,
        ]);

        session()->flash('success', "Post Updated Successfully");
        $this->resetFields();
        $this->editForm = false;
        $this->dispatch('close-edit-modal');

    }

    public function deletePost($id){
        $post = Post::find($id);

        if($post->user_id != Auth::id()){
            session()->flash('error', 'Unauthenticated');
            return;
        }

        $post->delete();

        session()->flash('success', "Post Deleted Successfully");
    }
}
