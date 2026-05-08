<?php

namespace App\Http\Controllers\Admin\Search;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = '%' . $request->search . '%';
        if ($request->keyword == 'categories') {
            $Categories = Category::where('name', 'LIKE', $search)->paginate(3);
            return view('admin.categories.index', compact('Categories'));
        } elseif ($request->keyword == 'contacts') {
            $contatcs = Contact::where('name', 'LIKE', $search)->orWhere('email', 'LIKE', $search)->paginate(3);
            return view('admin.Contact.index', compact('contatcs'));
        } elseif ($request->keyword == 'posts') {
            $posts = Post::where('title', 'LIKE', $search)->orWhere('desc', 'LIKE', $search)->paginate(3);
            return view('admin.posts.index', compact('posts'));
        } elseif ($request->keyword == 'users') {
            $users = User::where('name', 'LIKE', $search)->orWhere('email', 'LIKE', $search)->paginate(3);
            return view('admin.users.index', compact('users'));
        } else {
            return redirect()->back();
        }
    }
}
