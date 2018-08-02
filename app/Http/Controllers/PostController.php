<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Comments;
use Auth;
use Session;
use DB;
use App\Categories;
use DateTime;

class PostController extends Controller {

    
   public function __construct() {
     $this->middleware(['auth', 'isAdmin']);
       }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {

         if (Auth::check()) {
           
            $posts = Post::with('comments', 'categories')->get();
        
       $cmmnts = array();
       foreach ($posts as $post) { 
        
         /*
          $string = $post->categories_id;
         
          $cats = explode(',',$string); 

             $arr = array();
             
             foreach ($cats as $value) {

                 $cat = Categories::Find($value);

                $arr[] = $cat->name;
             }
             */
          $noofcomments = Comments::where('post_id', '=', $post->id)->count();

       $cmmnts[] = $noofcomments;
       }

        return view('posts.index', compact('posts', 'cmmnts'));
            } else {
                return view('auth.login');
            }
    }

    public function action(Request $request)
    {
        

        $input = $request->all();
      
       if($input['select'] == 'approved')
        {
          if($request['posts'] == ''){

        }else{
         $id = $input['posts'];
       
        DB::table('posts')->whereIn('posts.id', $id)->update(['posts.post_status' => 'Publish']);
    }
}
     if($input['select'] == 'unapproved')
        {
            if($request['posts'] == ''){

            }else{
         $id = $input['posts'];
       
        DB::table('posts')->whereIn('posts.id', $id)->update(['posts.post_status' => 'Pending for Review']);
    }
}

         if($input['select'] == 'trash')
                {
                    if($request['posts'] == ''){

                    }else{
                 $id = $input['posts'];
               
                DB::table('posts')->whereIn('posts.id', $id)->update(['posts.post_status' => 'Trash']);
            }
        }
     return redirect()->back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = DB::table('category')->select('category.*')->get();
      //  print_r($category);die();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 
       

      
    //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            ]);
      
        $input = $request->all();

        $id = Auth::user()->id;
       
         $user = Post::create($input);
         
         $cat = $input['category'];
          $category= implode(",",$cat);
         $user->categories_id = $category;
         $user->tags = $input['tags'];

         if (isset($input['post']))
         {
          $user->post_status = $input['post'];  
         }
         if (isset($input['visibility']))
         {
          $user->visibility = $input['visibility'];  
         }
         $user->author_id = $id;
         $user->created_by = $id;
        $user->save();
    //Display a successful message upon save
        return redirect()->route('posts.index')
            ->with('flash_message', 'Article,
             '. $user->title.' created');
    }
    
    public function search(Request $request){

        print_r($request->get());
        echo "string";die();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {

        
         $post = Post::where('id', $slug)
                    ->orWhere('slug', $slug)
                    ->firstOrFail();

        $posts = $post->categories()->get();   
            
        $commnts = DB::table('comments')->where('comments.post_id', '=', $post->id)->get();
         
          return view ('posts.show', compact('post', 'posts', 'commnts'));           
     
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      //  $posts = Post::findOrFail($id);
         $posts = Post::with('users')->findOrFail($id);
        
        
           
          $string = $posts->categories_id;
       
          $cats = explode(',',$string); 

             $arr = array();

             foreach ($cats as $value) {
                 $cat = Categories::Find($value);
                $arr[] = $cat->name;
               
             }
            
           // $postget =  DB::table('posts')->select('posts.*','category.*' )->join('category','category.id','=', $cats)->get();
           // $postget = DB::table('category')->whereIn('id',$cats)->get();           
       
       // $post = Post::find($id);
      
        //$selected = $post->tags->pluck('categories_id');
       
        return view('posts.edit', compact('posts', 'arr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $this->validate($request, [
            'title'=>'required|max:100',
            'body'=>'required',
        ]);
        $data = $request->all();
       $post = Post::findOrFail($id);
      
             //DB::table('posts')->where('post_status', 'Submit for Review')->update(['post_status' => 'publish']);
         
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->post_status = $data['status'];
        $post->save();

        return redirect()->route('posts.show', 
            $post->id)->with('flash_message', 
            'Article, '. $post->title.' updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug) {

        $post = Post::findOrFail($slug);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('flash_message',
             'Article successfully deleted');

    }
}