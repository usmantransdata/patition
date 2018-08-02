<?php

namespace App\Http\Controllers;

use App\DecisionMaker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DecisionMakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDecisionMaker(Request $request){
      //  print_r($request->all());dd();
        $inp  = $request['tag_list'];
      
           $ifexist= DecisionMaker::where('company', '=', $inp)->first();
         // print_r(count($ifexist));dd();
           if (count($ifexist) > 0) {
              $decisionMakerid[] = $ifexist->id;
                 }
                 else{
                 $decisionMaker = new DecisionMaker;
                 $decisionMaker->company =  $inp;
                 $decisionMaker->save();  
               //  $decisionMakerid[] = $decisionMaker->id;
                 return response ()->json($decisionMaker);
                              }
      
        
        }


 public function find(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $tags = DecisionMaker::search($term)->limit(5)->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->company, 'text' => $tag->company];
        }

        return \Response::json($formatted_tags);
    } 

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DecisionMaker  $decisionMaker
     * @return \Illuminate\Http\Response
     */
    public function show(DecisionMaker $decisionMaker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DecisionMaker  $decisionMaker
     * @return \Illuminate\Http\Response
     */
    public function edit(DecisionMaker $decisionMaker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DecisionMaker  $decisionMaker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DecisionMaker $decisionMaker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DecisionMaker  $decisionMaker
     * @return \Illuminate\Http\Response
     */
    public function destroy(DecisionMaker $decisionMaker)
    {
        //
    }

     public function imageCrop(Request $request){
        
          $data = $request->image;

       list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

            
        $data = base64_decode($data);
        $image_name= time().'.png';
        $path = public_path() . "/upload/" . $image_name;

        file_put_contents($path, $data);
        return $image_name;
        //return response()->json(['success'=>'done']);
    }
}
