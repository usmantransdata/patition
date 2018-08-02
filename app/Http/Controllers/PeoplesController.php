<?php

namespace App\Http\Controllers;

use App\Peoples;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\AsignTemplate;
use App\EmailTemplate;
use App\Petition;
use Mail;
use App\Mail\Email;
use App\Mail\Welcome;
use Auth;
use App\User;
use App\PeopleProfile;
use DB;
use Session;

class PeoplesController extends Controller
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
         $users = DB::table('users')->where('users.user_type', '=', 'frontend-user')->get(); 

        return view('peoples.index')->with('users', $users);
    }

    public function profile(){
        $id = Auth::user()->id;

        $petition = Petition::with('user','survey', 'comments', 'signPetition')->get();

        $profilePpls = DB::table('peoples_profile')->get(); 

        return view('frontend.profile.admin.index' , compact('profilePpls', 'petition'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

   protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'created_by' => $data['name'],
            'password' => bcrypt($data['password']),

        ]);
    }
    public function register(Request $request)
    {
         $input = $request->all();
            $validator = $this->validator($input);      
          
        if ($validator -> passes())
       {

           $profile = new PeopleProfile;
           
            $data = $this->create($input)->toArray();
            $data['verification_token'] = str_random(25);
            $user = User::find($data['id']);

            $temp = AsignTemplate::find(1);
            $email = EmailTemplate::findOrFail($temp->template_id)->first();    

            $data['subject']=$email->subject;
            $data['title']=$email->title;
            $user->verification_token = $data['verification_token'];
             $template=$this->replacement($email->template, $input); 
             $data['template']=$template; 
             $user['created_by'] = $data['id'];
             $user['is_delete'] = 0;
             $profile->nick_name = $input['name'];
              $profile->save();
             $user['user_type'] = $input['user_type'];

            $user->save();
             $roles = $request['roles']; //Retreive all roles
        
        if ($roles > 0) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
            }
        }
            Mail::to($data['email'])->send(new Welcome($data));
            Session::flush();

        return redirect()->route('frontend-login')
            ->with('flash_message',
             'User successfully added.');

       }
       else{
        
        return redirect()->back()->withErrors($validator)->withInput();

       }
      
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
