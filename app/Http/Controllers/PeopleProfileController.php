<?php

namespace App\Http\Controllers;

use App\PeopleProfile;
use App\Petition;
use App\Comments;
use App\SignPetition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Storage;
use File;
use DB;

class PeopleProfileController extends Controller
{
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $id = Auth::user()->id;
        $profile = PeopleProfile::where('user_id', '=', $id)->get();
      
     if(sizeof($profile) >= 1){
          $prfl = array('recordfound'=>sizeof($profile));
          }else{
              $prfl=array('recordfound'=>0);
          }
          $petitions = Petition::where('petition.user_id', '=', $id)->orderBy('created_at','desc')->paginate(4);

          $sign = Petition::where('user_id', '=', $id)->get();

     
    return view('frontend.profile.frontend-profile', compact('profile', 'prfl', 'petitions', 'sign_pet', 'sign', 'p'));

    }
    public function about(){

        return view('frontend.about');
    }
    public function contact(){

        return view('frontend.contact');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $id = Auth::user()->id;
       $input = $request->all();
         $file = $request->file('avatar');

      //  echo "string";
       $p = new PeopleProfile;

       $p->nick_name = $input['nick_name'];
       $p->about = $input['description'];
       $p->city = $input['city'];
       $p->province = $input['state'];
       $p->country = $input['country'];
       $p->company = $input['company'];
       $p->phone = $input['phone'];
       $p->occupation = $input['occupation'];
       $p->education = $input['education'];
       $p->web_site = $input['web_site'];
       $p->dob = $input['dob'];
       $p->interest = $input['intrests'];

         if(isset($file)){

           $extension = $file->getClientOriginalExtension();
           Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
            $p->avatar = $file->getFilename().'.'.$extension;
                }

        $p->user_id = $id;        
       $p->save();

        $profile = PeopleProfile::where('user_id', '=', $id)->get();

             if(sizeof($profile) >= 1){

     $prfl = array('recordfound'=>sizeof($profile));
        //$petition = Petition::where('signPetition.user_id', '=', $user_id)->findorFail($petition->id);
  }else{
      $prfl=array('recordfound'=>0);

  }

        return redirect()->route('frontend-profile')
                             ->with('profile',
                              'You have sucessfully create your profile');

        /*view('frontend.profile.frontend-profile', compact('profile', 'prfl', ''))*/

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PeopleProfile  $peopleProfile
     * @return \Illuminate\Http\Response
     */
    public function show(PeopleProfile $peopleProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeopleProfile  $peopleProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleProfile $peopleProfile)
    { 

     $id = Auth::user()->id;
        $profile = PeopleProfile::where('user_id', '=', $id)->get();

             if(sizeof($profile) >= 1){
     $prfl = array('recordfound'=>sizeof($profile));
        //$petition = Petition::where('signPetition.user_id', '=', $user_id)->findorFail($petition->id);
  }else{
      $prfl=array('recordfound'=>0);
  }
        
        return view('frontend.profile.edit-profile', compact('profile', 'prfl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeopleProfile  $peopleProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
       $id = Auth::user()->id;
       $input = $request->all();
        $file = $request->file('avatar');


        $p = PeopleProfile::where('user_id', '=', $user_id)->first();
      
        $p->nick_name = $input['nick_name'];
        $p->phone = $input['phone'];
        $p->city = $input['city'];
        $p->country = $input['country'];
        $p->company = $input['company'];
        $p->dob = $input['dob'];
        $p->education = $input['education'];
        $p->occupation = $input['occupation'];
        $p->interest = $input['intrests'];

         if(isset($file)){

           $extension = $file->getClientOriginalExtension();
           Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
            $p->avatar = $file->getFilename().'.'.$extension;
                }


        $p->save();
  
        return redirect()->route('frontend-profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeopleProfile  $peopleProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleProfile $peopleProfile)
    {
        //
    }
}
