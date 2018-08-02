<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;

class CategoriesController extends Controller
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
        if (Auth::check()) {
            //$userId = Auth::user()->id;

          // $posts =  DB::table('posts')->select('posts.*','users.*' )->join('users','users.id','=','posts.author_id')->get();

            $category = Categories::get();
           // $posts = $user->user_id()->get();
      
        return view('categories.index', compact('category'));
            } else {
                return view('auth.login');
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('categories.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
        ]);
    }

    public function store(Request $request)
    {
          $input = $request->all();
        $validator = $this->validator($input);  
       
       if ($validator -> passes())
       {

        $user = Categories::create($input);
        $user->created_by = Auth::user()->name;
        $user->save(); 
    //Display a successful message upon save
        return redirect()->route('categories.index')
            ->with('flash_message', 'Categories ,
             '. $user->title.' created');
        } else{
        
        return redirect()->back()->withErrors($validator)->withInput();

       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $category = Categories::get();
            return view('categories.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $categories = Categories::findOrFail($id);

        return view('categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cats = Categories::findOrFail($id);
        $cats->name = $request->input('name');
        $cats->save();

        return redirect()->route('categories.show', 
            $cats->id)->with('flash_message', 
            'Categories, '. $cats->title.' updated');

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
