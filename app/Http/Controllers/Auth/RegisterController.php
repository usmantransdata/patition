<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Http\Request;
use App\AsignTemplate;
use App\EmailTemplate;
use Mail;
use App\Mail\Email;
use App\Mail\Welcome;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    use VerifiesUsers;

  public function __construct() {
        $this->middleware(['auth', 'isAdmin']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
 
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

     protected function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $request->input('email'), 'password' => $request->input('password'))))
        {
            if(auth()->user()->verified == '0'){
                $this->logout();
                return back()->with('warning',"First please active your account.");
            }
            return redirect()->to('/frontend');
        }else{
            return back()->with('error','your username and password are wrong.');
        }
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
            $user->save();
             $roles = $request['roles']; //Retreive all roles
        
        if (isset($roles)) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
            }
        }
			Mail::to($data['email'])->send(new Welcome($data));
            Session::flush();

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully added.');

       }
       else{
        
        return redirect()->back()->withErrors($validator)->withInput();

       }
      
    }

    public function confirmation($verification_token){
      print_r($verification_token);die();

        $user = User::where('verification_token', $verification_token)->first();
        if(!is_null($user)){
            $user->verified = 1;
            $user->verification_token = '';
            $user->save();
            return redirect('/frontend')->with('status', 'Your activation is complete');
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
