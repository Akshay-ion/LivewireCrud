<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Posts extends Component
{
    public $posts, $title, $body, $postForm = false;

    public function render()
    {
        $this->posts = Post::latest()->get();
        return view('livewire.posts');
    }

    public function addPost(){
        $this->postForm = true;
    }

    public function closePost(){
        $this->postForm = false;
    }

    public function resetFields(){
        $this->title = "";
        $this->body = "";
        $this->postForm = false;
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
    }
}
