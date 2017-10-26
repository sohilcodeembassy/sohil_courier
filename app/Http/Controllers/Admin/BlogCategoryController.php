<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Blog_category;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function blogCategory(){
    	$blog_category = Blog_category::orderBy('created_at', 'desc')->get();
    	return view('admin.BlogCategory.blogCategory',['blog_category' => $blog_category]);
    }

    public function postBlogCategory(Request $request){
    	$this->validate($request, [
    		'category_name' => 'required|string|max:30',
            'status' => 'required|numeric',
    	]);

    	$blog_category = new Blog_category();
    	$blog_category->name = $request->category_name;
    	$blog_category->status = $request->status;

    	if($blog_category->save()){
            return redirect()->route('admin.blog_category')->with('success', 'Category add successfully!');
        }else{
            return redirect()->route('admin.blog_category')->with('error', 'Some problem for add Category');
        }
    }

    public function editBlogCategory($id){
    	$blog_category = Blog_category::where('id','=',$id)->first();
    	return view('admin.BlogCategory.editBlogCategory',['blog_category' => $blog_category]);
    }

    public function postEditBlogCategory(Request $request){
    	$this->validate($request, [
    		'category_name' => 'required|string|max:30',
            'status' => 'required|numeric',
    	]);

    	$blog_category = Blog_category::where('id','=',$request->id)->first();
    	$blog_category->name = $request->category_name;
    	$blog_category->status = $request->status;

    	if($blog_category->save()){
            return redirect()->route('admin.blog_category')->with('success', 'Category update successfully!');
        }else{
            return redirect()->route('admin.blog_category')->with('error', 'Some problem for update Category');
        }
    }

}
