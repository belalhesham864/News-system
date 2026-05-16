<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(){
        $categories=Category::activee()->get();
        if(!$categories){
            return apiResponse(404,'Not Found');
        }
        return apiResponse(200,"All categories",new CategoryCollection($categories));
    }
    public function getCategoryposts($slug){
        $category=Category::where('slug',$slug)->activee()->first();
        if(!$category){
            return apiResponse(404,'Not Found');
        }
        $posts=$category->posts;
        return apiResponse(200,"this category posts",new PostCollection($posts));
    }
}
