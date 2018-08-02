<?php

namespace App\Http\Controllers;

use App\SignPetition;
use App\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class SignPetitionController extends Controller
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
    public function create(Request $request, $id)
    {
       
       $input = $request->all();

       $sign = new SignPetition;
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;

         if(isset($input['name']) && $input['email'] ){
            $sign->user_name = $input['name'];
            $sign->user_email = $input['email'];
        }
        $sign->user_id = $user_id;
        $sign->answer = $input['answer'];
        $sign->user_name = $user_name;
        $sign->user_email = $user_email;
        $sign->petition_id = $id;
        $sign->save();
        
        return redirect()->back();
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SignPetition  $signPetition
     * @return \Illuminate\Http\Response
     */
    public function show(SignPetition $signPetition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SignPetition  $signPetition
     * @return \Illuminate\Http\Response
     */
    public function edit(SignPetition $signPetition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SignPetition  $signPetition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SignPetition $signPetition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SignPetition  $signPetition
     * @return \Illuminate\Http\Response
     */
    public function destroy(SignPetition $signPetition)
    {
        //
    }
}
