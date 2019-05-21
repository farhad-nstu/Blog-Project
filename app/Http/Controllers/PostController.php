<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Session;
use Image;
use DB;
use App\Category;
use Storage;

class PostController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }


    /** 
    * display a listing of the resource
    * 
    * @return \Illuminate\Http\Response
    */
    public function getIndex(){
        // Create a variable and store all blog posts in it from database
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index')->withPosts($posts);
    }

    /** 
    * how the form for creating a new resource
    * 
    * @return \Illuminate\Http\Response
    */
    public function getCreate(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

      
    /**
     * store a newly resource 
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'  => 'required',
            'featured_img' => 'required|image'
        ));

        $post = new Post;
        
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;
        
        
        //save our image
        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(100, 100)->save($location);

            $post->image = $filename;
        }


        $post->save(); 

        $post->tags()->sync($request->tags, false);

       

 
        
        Session::flash('success', 'The blog was successfully save!');
        return redirect()->route('posts.show', $post->id);

        //return redirect()->back();
    
    }

    

    // Edit is here
    public function edit($id)
    {
        // find the post in the database and save as a var
        $post = Post::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        // return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }


    public function update(Request $request, $id)
    {
        // Validate the data
        $post = Post::find($id);
        /* if ($request->input('slug') == $post->slug) {
            $this->validate($request, array(
                'title' => 'required|max:255',
                'category_id' => 'required|integer',
                'body'  => 'required'
            ));
        } else { */
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug'  => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
                'category_id' => 'required|integer',
                'body'  => 'required',
                'featured_img' => 'image'
            ));
        
        // Save the data to the database
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = $request->input('body');

        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(100, 100)->save($location);
            $oldFilename = $post->image;

            $post->image = $filename;

            Storage::delete($oldFilename);
        }

        $post->save();



        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }
        // set flash data with success message
        Session::flash('success', 'This post was successfully saved.');
        // redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }



    
    
    /* public function updatePost(Request $request,$id){

        $post = Post::find($id);
        if($request->input('slug') == $post->slug){
            $validateData = $request->validate([
                'title' => 'required|max:255',
                'category_id' => 'required|integer',
                'body' => 'required||max:255',
            ]); 

        } else{
            $validateData = $request->validate([
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id' => 'required|integer',
                
                'body' => 'required||max:255',
                
            ]);
        }
        
        
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = $request->input('body');

        

        $post->save();

        $post->tags()->sync($request->tags);
       
        
        /*if(isset($request->tags)){
            $post->posts()->sync($request->tags);
        } else{
            $post->posts()->sync(array());
        } 
        

        
       
        //$post->tags()->sync($request->tags, $post); 
        
        Session::flash('success', 'The blog was successfully save!');
        return redirect()->route('posts.show', $post->id);


        
} */


    // Delete Post

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->tags()->detach();
        Storage::delete($post->image);
        $post->delete();
        Session::flash('success', 'The post was successfully deleted.');
        return redirect()->route('posts.index');
    }
    /*public function deletePost($id){
        $delete=DB::table('posts')
                ->where('id',$id)
                ->first();
     
        $dltuser=DB::table('posts')
                ->where('id', $id)
                ->delete();
                
        if ($dltuser) {
            $notification=array(
            'messege'=>'Successfully Deleted Post',
            'alert-type'=>'success'
            );
            return Redirect()->route('posts.all')->with($notification);                      
        } else{
            $notification=array(
            'messege'=>'error ',
            'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        } 
    } */



    

    /**
     * dipaly the sourcs
     * 
     * @param int $id
     * @return @return \Illuminate\Http\Response
     */
    function show($id){
        $post = Post::find($id);
       
        return view('posts.show', compact('post'));
        //return 1;
        
    }

    
    
    

    
}
