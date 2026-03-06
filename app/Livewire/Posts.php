<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Posts extends Component
{
    public $title, $body, $postForm = false, $editForm=false, $postId;

    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::latest()->get()
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
    }
}
