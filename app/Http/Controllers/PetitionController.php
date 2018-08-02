<?php

namespace App\Http\Controllers;

use App\Petition;
use App\SignPetition;
use App\Comments;
use App\DecisionMaker;
use App\PeopleProfile;
use App\User;
use App\Categories;
use App\Survey;
use App\SurveyResult;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use Illuminate\Http\Request;
use Auth;
use DB;

class PetitionController extends Controller
{

  public function decision(){

$decision_maker = DecisionMaker::orderBy('id', 'DESC')->get();
      return response()->json($decision_maker);
     //return Response::json($decision_maker);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id = Auth::user()->id;
        $category = Categories::get();

          $decision_maker = DecisionMaker::orderBy('id', 'DESC')->get();
          $survey = Survey::where('user_id', '=', $id)->get();
        
        return view('frontend.petition.create', compact('category', 'decision_maker', 'survey'));
    }
    public function pet()
        {
        $id = Auth::user()->id;
      //  $petition = DB::table('petition')->where('petition.user_id', '=', $id)->get();
        $petition = Petition::where('petition.user_id', '=', $id)->orderBy('id', 'DESC')->paginate(4);
         $user  = PeopleProfile::where('user_id', '=', $id)->first();
         $sign = SignPetition::where('user_id', '=', $id)->get();
         
    return view('frontend.petition.frontendUserDashboard', compact('petition', 'user', 'sign'));

    }

      public function categoryView($id)
       {
        //$input = Request::all();.
        $cat=Categories::find($id);
        //print_r($cat->id);dd();
        $topCategories = Categories::get();
       $petitions = Petition::whereIn('categories_id', [$cat->id])->paginate(5);
      
       return view('frontend.pages.browseCategory', compact('cat', 'petitions','topCategories'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
            $id = Auth::user()->id;
            $input = $request->all();
           // print_r($input);dd();
            
            $survey = new Survey;
            $survey->title = $input['title'];
            $survey->question = $input['question'];
             /* if(Request::has('short')){
            $survey->option1 = 'short';
              }
             if(Request::has('paragraph')){
            $survey->option1 = 'paragraph';
              }*/
              if($input['option']){
                $options = serialize($input['option']);
        $survey->option1 = $options;
        $survey->option2 = 'serializeData';
              }
           // $survey->correct_answer = $input['correct_answer'];
            $survey->user_id = $id;
            $survey->save();
             return redirect()->back();
    }

    public function survey($id){

        $last_id = $id;
        return view('frontend.survey.create', compact('last_id'));
    }

  public function searchMe(Request $request){
    $input = Request::all();
    $id = Auth::user()->id;
    $cat=Categories::find($id);
    $output = '';
$petitions=DB::table('petition')->where('title','LIKE','%'.$input['search']."%")->get();

 return view('frontend.pages.browseCategory', compact('petitions', 'cat'));
 
 
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
       $id = Auth::user()->id;
        $input = $request->all();
          
            $petition = new Petition;
           $petition->title = $input['title'];
           $petition->description = $input['description'];

           if( !empty ($input['categories'])){
            $cat = $input['categories'];
            $category= implode(",",$cat);
           $petition->categories_id = $category;
         }
         if( !empty ($input['tag_list'])){
            $decision_maker = $input['tag_list'];
            $decision= implode(",",$decision_maker);
          //  print_r($decision);dd();
           $petition->decision_maker = $decision;
         }

           if( !empty ($input['survey'])){
            $survey = $input['survey'];
            $petition_survey= implode(",",$survey);
          //  print_r($decision);dd();
           $petition->survey_id = $petition_survey;
         }
            $petition->message =  $input['description'];
            $petition->avatar =  $input['avatar'];
            $petition->user_id =  $id;
            $petition->save();
         // $decisionMakerid=array();
         
       /*         if($input['tag_list'] !== null){
            foreach ($tagList as $key => $value) {
             $ifexist=DecisionMaker::where('company', '=', $value)->first();
            
             if (count($ifexist) > 0) {
                 //echo "<pre>";
                 //print_r($ifexist);
            // if(DB::table('decision_maker')->where('decision_maker.company', $value)){
                 $decisionMakerid[] = $ifexist->id;
                 }
                 else{
                 $decisionMaker = new DecisionMaker;
                 $decisionMaker->company =  $value;
                 $decisionMaker->save();  
                 //echo ($value);          
                // echo $decisionMaker->id."asa";
                 $decisionMakerid[] = $decisionMaker->id;
                  }
            }  
             $decisionMakerid=serialize($decisionMakerid);
                $petition->company = $decisionMakerid;
            }*/
               
               
           return redirect('pet');
         }


         /*

      print_r(Request::all());dd();
         
          if(Request::has('petition_survey')){
                $id = Auth::user()->id;
           $file = Request::file('avatar');
           $tagList = Request::Input('tag_list');
            $petition = new Petition;
           $petition->title = Request::Input('title');
           $petition->description = Request::Input('description');
           if(Request::Input('category') != null){
            $cat = Request::Input('category');
              $category= implode(",",$cat);
           $petition->categories_id = $category;
            }
            $petition->message =  Request::Input('description');
            $petition->user_id =  $id;

              if(isset($file)){
                   $extension = $file->getClientOriginalExtension();
                   Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
                    $petition->avatar = $file->getFilename().'.'.$extension;
                        }

          $decisionMakerid=array();
                if(Request::Input('tag_list') !== null){
            foreach ($tagList as $key => $value) {  
             $ifexist=DecisionMaker::where('company', '=', $value)->first();
            
             if (count($ifexist) > 0) {
              $decisionMakerid[] = $ifexist->id;
                 }
                 else{
                 $decisionMaker = new DecisionMaker;
                 $decisionMaker->company =  $value;
                 $decisionMaker->save();  
                 $decisionMakerid[] = $decisionMaker->id;
                  }
            }  
             $decisionMakerid=serialize($decisionMakerid);
                $petition->company = $decisionMakerid;
            }
                $petition->save();
               
               $last_id = $petition->id;

                return redirect()->route('petition-survey', compact('last_id'));

          }

       if(Request::has('petition')){

           $id = Auth::user()->id;
           $file = Request::file('avatar');
           $tagList = Request::Input('tag_list');
            $petition = new Petition;
           $petition->title = Request::Input('title');
           $petition->description = Request::Input('description');
           if(Request::Input('category') != null){
            $cat = Request::Input('category');
              $category= implode(",",$cat);
           $petition->categories_id = $category;
         }
            $petition->message =  Request::Input('description');
            $petition->user_id =  $id;

              if(isset($file)){
                   $extension = $file->getClientOriginalExtension();
                   Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
                    $petition->avatar = $file->getFilename().'.'.$extension;
                        }
          $decisionMakerid=array();
          // $tags = explode(" ",$tagList);
            // echo (); 
                if(Request::Input('tag_list') !== null){
            foreach ($tagList as $key => $value) {
            
             
             $ifexist=DecisionMaker::where('company', '=', $value)->first();
            
             if (count($ifexist) > 0) {
                 //echo "<pre>";
                 //print_r($ifexist);
            // if(DB::table('decision_maker')->where('decision_maker.company', $value)){
                 $decisionMakerid[] = $ifexist->id;
                 }
                 else{
                 $decisionMaker = new DecisionMaker;
                 $decisionMaker->company =  $value;
                 $decisionMaker->save();  
                 //echo ($value);          
                // echo $decisionMaker->id."asa";
                 $decisionMakerid[] = $decisionMaker->id;
                  }
            }  
             $decisionMakerid=serialize($decisionMakerid);
                $petition->company = $decisionMakerid;
            }
                $petition->save();
               
           return redirect('pet');
   }
    }*/

    public function publish(Request $request, $petition)
    {

        $id = Auth::user()->id;
        $profile = DB::table('peoples_profile')->where('peoples_profile.user_id', '=', $id)->get();

       foreach ($profile as $value) {
                    if(!empty($value->phone))
                      {
                        $pet = Petition::findorFail($petition);

                        
                        $pet->publish = 1;
                        $pet->update();

                   }else
                   {
                    return redirect()->route('frontend-profile')
                             ->with('message',
                              'Please Update required missing information to publish your petition publicly');
                   }
         return redirect()->back();
  }

  

 // return view('frontend.profile.frontend-profile');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function show(Petition $petition)
    {

        if(Auth::check()){
            $id = Auth::user()->id;
            $profile = PeopleProfile::where('user_id', '=', $id)->first();
         $ifsignpetition = SignPetition::where('user_id', '=', $id)->where('petition_id','=',$petition->id)->first();
               $petition= Petition::findorFail($petition->id); 
                        if(sizeof($ifsignpetition) >= 1){
                         $signpetition=array('recordfound'=>sizeof($ifsignpetition));
                         }else{
                          $signpetition=array('recordfound'=>0);
                                }
   // $comments = DB::table('comments')->where('comments.petition_id', '=', $petition->id)->get();
            /*$cats Categories::whereIn('id', $petition->categories_id)->get();   print_r($ca)     */                      
           $decisionMakers = unserialize($petition->company);
            if($decisionMakers != null){
                 $dm = DB::table('decision_maker')->whereIn('id', $decisionMakers)->get();
                }
                $user  = PeopleProfile::where('user_id', '=', $id)->first();
            $survey = DB::table('petition_survey')->where('petition_survey.petition_id', '=', $petition->id)->first();
          $result = DB::table('petition_result')->where('petition_result.petition_id', '=', $petition->id)->first();
            
          return view('frontend.petition.petitionFullView', compact('petition', 'comments','signpetition', 'dm', 'user', 'survey', 'result'));

                        }else

                    {
                        return redirect()->route('frontend-profile');
                    }
              
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function edit(Petition $petition)
    {
           
            $petition = Petition::findorFail($petition->id);
           
            $profile = PeopleProfile::where('user_id', '=', $petition->user_id)->first();
           
           $comments = DB::table('comments')->where('comments.petition_id', '=', $petition->id)->get();
        return view('frontend.petition.manage', compact('petition', 'comments', 'profile')); 

    }


    public function petEdit($id)

    {

        $petition = Petition::findorFail($id);;

    return view('frontend.petition.edit', compact('petition')); 
   

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $input = Request::all();
     // print_r($input);dd();
      $petition= Petition::find($id);
      $petition->title = $input['title'];
      $petition->message = $input['message'];
      $petition->save();
        
        return redirect()->route('browsePetition');
    }

   
    /**
    * petition browse page
    *redirect browse petition page 
    **/

    public function browsePetition()
    {
      $petitions =  Petition::with('signPetition')->paginate(12);

       // $hec = array();
        foreach ($petitions as $value) {
          $hec[] = $value->categories_id;
           }
      // print_r($hec);dd();
       $categories = Categories::paginate(12);
       
      return view('frontend.pages.browsePetition',  compact('petitions',  'categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petition $petition)
    {
        //
    }
}
