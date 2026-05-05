<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Statistics extends Component
{
    public function render()
    {
        $active_categories_count=Category::where('status',1)->count();
        $active_posts_count=Post::where('status',1)->count();
        $active_users_count=User::where('status',1)->count();
        $comment_count=Comment::count();
        return view('livewire.admin.statistics',[
            'active_categories_count'=>$active_categories_count,
            'active_posts_count'=>$active_posts_count,
            'active_users_count'=>$active_users_count,
            'comment_count'=>$comment_count,
        ]);
    }
}
