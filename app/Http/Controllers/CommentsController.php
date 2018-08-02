<?php

namespace App\Http\Controllers;

use App\comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\User;
use DB;

class CommentsController extends Controller
{

      public function __construct() {
     $this->middleware(['auth', 'isAdmin']);
       }
       
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $comments = Comments::with('user', 'post')->get();
      
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        //
    }
     public function comment(Request $request, $id){


        $input = $request->all();
      
         $user_id = Auth::user()->id;
         $email = Auth::user()->email;

        $comment = new Comments();
        $comment->petition_id = $id;
        $comment->user_id = $user_id;
        if(isset($input['email'])){
             $comment->user_email = $input['email'];

        }else{
             $comment->user_email = $email;
        }
        $comment->created_by = $user_id;
        $comment->comments_approved = 1;  
       
        $comment->comment = $input['comments'];
        $comment->save();

        Session::flash('success', 'Comments Was Added');
         return redirect()->back();
             }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {   

         $input = $request->all();
        
         $user_id = Auth::user()->id;
         $email = Auth::user()->email;

        $comment = new Comments();
        $comment->post_id = $id;
        $comment->user_id = $user_id;
        $comment->user_email = $email;
        $comment->created_by = $user_id;

         if ( auth()->user()->isAdmin())
         {
          $comment->comments_approved = 1;  
         }
         else
         {
            $comment->comments_approved = 0;  
         }
        $comment->comment = $input['comments'];
        $comment->save();

        Session::flash('success', 'Comments Was Added');

       

       /* Comments::create([
            'post_id' => $id,
            'user_id' => $user_id,
            'user_email' => $email,
            'created_by' => $user_id,
            'comments' => $input['comments'],

        ]);*/
       /* $cmmnts = Comments::create($input);
        $cmmnts->post_id = $id;
        $cmmnts->user_id = $user_id;
        $cmmnts->user_email = $email;
        $cmmnts->created_by = $user_id;
        $cmmnts->comments = $input['comments'];
        $cmmnts->save();
        */
         return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comments $comments)
    {
        //
    }

    public function action(Request $request){


       
        $input = $request->all();
        //print_r($input);die();
        
        if($input['select'] == 'approved')
        {
           if($request['input'] == ''){
           
           }else{
           
             $id = $input['input'];
       
        DB::table('comments')->whereIn('comments.id', $id)->update(['comments.comments_approved' => 1]);
    }
     }

       if ($input['select'] == 'unapproved') {

         if($request['input'] == ''){
           
           }else{
                $id = $input['input'];
                DB::table('comments')->whereIn('comments.id', $id)->update(['comments.comments_approved' => 0]);
          
         }   
         }  

         if ($input['select'] == 'trash') {

         if($request['input'] == ''){
           
           }else{
                $id = $input['input'];
                DB::table('comments')->whereIn('comments.id', $id)->update(['comments.comments_type' => 'Trash']);
          
         }   
         }  
       return redirect()->back();
        //echo "string";die();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(comments $comments)
    {
        //
    }
}
