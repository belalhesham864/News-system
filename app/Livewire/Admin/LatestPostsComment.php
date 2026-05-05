<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class LatestPostsComment extends Component
{
    public function render()
    {
        $latest_posts=Post::withCount('comment')->whereStatus(1)->latest()->take(5)->get();
        $latest_comment=Comment::with(['post','user'])->latest()->take(5)->get();
        return view('livewire.admin.latest-posts-comment',[
            'latest_posts'=>$latest_posts,
            'latest_comment'=>$latest_comment
        ]);
    }
}
