<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use DB;
use App\AsignTemplate;
use App\EmailTemplate;
use Mail;
use App\Mail\Email;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Validator;


//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class UserController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
    //Get all users and pass it to the view
       $users = User::all(); 

        return view('users.index')->with('users', $users);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
    //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required'
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
 public function store(Request $request) {
    //Validate name, email and password fields
       

       $input = $request->all();
        $validator = $this->validator($input);  
       
       if ($validator -> passes())

       {
        $user = User::create($request->only('email', 'name', 'password')); //Retrieving only the email and password data
        $roles = $request['roles']; //Retreive all roles
        
        if (isset($roles)) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
            }
        }
           
            $temp = AsignTemplate::find(1);
            $email = EmailTemplate::findOrFail($temp->template_id)->first(); 
            $data['subject']=$email->subject;           
            $data['title']=$email->title;  

            $template=$this->replacement($email->template, $input); 
             $data['template']=$template; 
             Mail::to($input['email'])->send(new Welcome($data));
       

          //return back()->withAlert('Register successfully, please verify your email.');
           return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully added.');

       }
       else{
        
        return redirect()->back()->withErrors($validator)->withInput();

       }
     
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id) {
        return redirect('users'); 
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id) {
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('users.edit', compact('user', 'roles')); //pass user and roles data to view

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id) {

        $user = User::findOrFail($id); //Get role specified by id

    //Validate name, email and password fields  
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);
        $input = $request->only(['name', 'email', 'password']); //Retreive the name, email and password fields
        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if (isset($roles)) {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully edited.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request, $id) {
    //Find a user with a given id and delete
        $user = User::findOrFail($id); 
        $input = $request->only(['is_delete']);
      //  $user['verified'] = 0;
        $user['deleted_by'] = $id;
        $user['is_delete'] = 1;
        $user->fill($input)->save();
        

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully deleted.');
    }

    public function active(Request $request, $id){
        $user = User::findOrFail($id); 
        $input = $request->only(['is_delete']);
        
        $user['is_delete'] = 0;
        $user->fill($input)->save();
        

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully deleted.');
    }


public function replacement($string, array $placeholders)
     {
    $resultString = $string;


    foreach($placeholders as $key => $value) {

        if(!is_array($value)){
      
        $resultString = str_replace('[' . $key . ']' , $value, $resultString, $i);
        
       }
    }
      return $resultString;
    }


	
   
}