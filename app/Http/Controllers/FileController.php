<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Storage;
use File;

class FileController extends Controller

{


    protected function frontendLogin(Request $request)
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

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function getWysiwyg()

    {

        return view('summernote');

    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function postWysiwyg(Request $request)

    {

        $this->validate($request, [

            'detail' => 'required',

        ]);

        $detail=$request->input('detail');

        $dom = new \DomDocument();

        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    

        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){

            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);

            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);

            $image_name= "/upload/" . time().$k.'.png';

            $path = public_path() . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');

            $img->setAttribute('src', $image_name);

        }

        $detail = $dom->saveHTML();

        dd($detail);

    }
      public function logout(){
      Auth::logout();
     return redirect('/frontend');
    }


     public function index()
    {
         $users = DB::table('users')->where('users.user_type', '=', 'frontend-user')->get(); 

        return view('peoples.index')->with('users', $users);
    }

      public function frontend(){

            return redirect()->to('frontend');
    }
    public function login(){

            return view('frontend.login');
    }

    public function signup(){

        return view('frontend.register');
    }

    


}