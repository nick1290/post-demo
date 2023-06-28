<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post as ModelsPost;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Post extends Component
{

    use WithFileUploads;
    public ModelsPost $postModel;
    public Comment $commentModel;
    public $title;
    public $content;
    public $image;
    public $posts;
    public $comment;

    public function render()
    {
        return view('livewire.post');
    }

    public function mount()
    {
        $this->postModel = new ModelsPost();
        $this->commentModel = new Comment();
        $this->posts = ModelsPost::with(['user','comments'])->orderBy('id','desc')->get();
    }

    public function createPost()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $this->image->store('public/posts');

        $fileName = time() .'.'. $this->image->getClientOriginalExtension();
        Storage::disk('public')->put($fileName, $this->image->get());

        ModelsPost::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'description' => $this->content,
            'image' => $fileName,
        ]);

        $this->reset(['title', 'content', 'image']);

        session()->flash('postmsg', 'Post created successfully!');
    }

    public function bindPosts()
    {
        $this->posts = ModelsPost::with(['user','comments'])->orderBy('id','desc')->get();
    }

    public function addComment($postId){
        $this->commentModel->create([
            'user_id' => 1,
            'post_id' => $postId,
            'comment' => $this->comment[$postId],
        ]);
         $this->reset(['comment']);
    }
}
