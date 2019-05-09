<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
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

    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $data = DB::table('users')->where('email', '=', $email)->get();
        if(count($data) == 0){
            $response = array('result'=>false, 'data'=>'New eamil');
        } else{
            $response = array('result'=>true, 'data'=>'This email is already exist');
        }
        return json_encode($response);
    }

    public function checkUsername(Request $request)
    {
        $username = $request->username;
        $data = DB::table('users')->where('username', '=', $username)->get();
        if(count($data) == 0){
            $response = array('result'=>true, 'data'=>'This username is available!');
        } else{
            $response = array('result'=>false, 'data'=>'that username is not available');
        }
        return json_encode($response);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
