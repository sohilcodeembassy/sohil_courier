<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Blog;
use App\Blog_category;

use Image;
use File;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function blog(){
    	$blogs = Blog::orderBy('created_at', 'desc')->get();
    	$blog_category = Blog_category::orderBy('created_at', 'desc')->get();

    	return view('admin.Blog.blog',['blogs' => $blogs, 'blog_category' => $blog_category]);
    }

    public function postBlog(Request $request){
    	$this->validate($request, [
    		'title' => 'required|string|max:30',
    		'blog_category' => 'required',
    		'description' => 'required',
    		'blog_image' => 'image|mimes:jpeg,png,jpg|max:50480',
            'status' => 'required|numeric',
    	]);

    	$blog_image_path = public_path().'/backend/assets/images/blog_images/';
    	$blog_image_thumbnail_path = public_path().'/backend/assets/images/blog_images/thumbnail/';
    	if(!File::exists($blog_image_path)) {
            File::makeDirectory($blog_image_path, $mode = 0777, true, true);
        }
        if(!File::exists($blog_image_thumbnail_path)) {
            File::makeDirectory($blog_image_thumbnail_path, $mode = 0777, true, true);
        }

        if($file = $request->hasFile('blog_image')) {
        	$file = $request->file('blog_image') ;
            $ext = $file->getClientOriginalExtension();
            $fileName = date('Ymdhsi').'.'.$ext;

            $thumb_img = Image::make($file->getRealPath())->resize(100, 100);
            $thumb_img->save($blog_image_thumbnail_path.'/'.$fileName,80);

            $file->move($blog_image_path,$fileName);

            $blog = new Blog();
            $blog->blog_category_id = $request->blog_category;
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->image = $fileName;
            $blog->status = $request->status;

            if($blog->save()){
	            return redirect()->route('admin.blog')->with('success', 'Blog add successfully!');
	        }else{
	            return redirect()->route('admin.blog')->with('error', 'Some problem for add Blog');
	        }

        }else{
        	return redirect()->route('admin.blog')->with('error', 'Some problem for add Blog');
        }
    }

    public function downloadBlogImage($img_name){
        $path = 'backend/assets/images/blog_images/'.$img_name;
        return response()->download($path);
    }

    public function editBlog($id){
    	$blog = Blog::where('id','=',$id)->first();
    	$blog_category = Blog_category::orderBy('created_at', 'desc')->get();
    	return view('admin.Blog.editBlog',['blog' => $blog, 'blog_category' => $blog_category]);
    }

    public function postEditBlog(Request $request){

    	$this->validate($request, [
    		'title' => 'required|string|max:30',
    		'blog_category' => 'required',
    		'description' => 'required',
            'status' => 'required|numeric',
    	]);

    	$blog_image_path = public_path().'/backend/assets/images/blog_images/';
    	$blog_image_thumbnail_path = public_path().'/backend/assets/images/blog_images/thumbnail/';
    	if(!File::exists($blog_image_path)) {
            File::makeDirectory($blog_image_path, $mode = 0777, true, true);
        }
        if(!File::exists($blog_image_thumbnail_path)) {
            File::makeDirectory($blog_image_thumbnail_path, $mode = 0777, true, true);
        }

        $blog = Blog::where('id','=',$request->id)->first();

        if($file = $request->hasFile('blog_image')) {

        	$blog_image = $blog->image;
	        $delete_blog_image_path = $blog_image_path.$blog_image;
	        $delete_blog_image_thumbnail_path = $blog_image_thumbnail_path.$blog_image;
	        unlink($delete_blog_image_path);
	        unlink($delete_blog_image_thumbnail_path);

        	$file = $request->file('blog_image') ;
            $ext = $file->getClientOriginalExtension();
            $fileName = date('Ymdhsi').'.'.$ext;

            $thumb_img = Image::make($file->getRealPath())->resize(100, 100);
            $thumb_img->save($blog_image_thumbnail_path.'/'.$fileName,80);

            $file->move($blog_image_path,$fileName);

            
            $blog->blog_category_id = $request->blog_category;
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->image = $fileName;
            $blog->status = $request->status;

        }else{

            $blog->blog_category_id = $request->blog_category;
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->status = $request->status;
        }

        if($blog->save()){
	        return redirect()->route('admin.blog')->with('success', 'Blog update successfully!');
	    }else{
	        return redirect()->route('admin.blog')->with('error', 'Some problem for update Blog');
	    }

    }

}
