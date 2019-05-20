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
            $response = array('result'=>false, 'data'=>'That username is not available');
        }
        return json_encode($response);
    }

    public function signup(Request $request)
    {
        $email_address = $request->email_address;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $image = $request->image;
        $location = $request->location;
        $interests = $request->interests;
        $roles = $request->roles;
        $spotlight = $request->spotlight;
        $spotlight_link = $request->spotlight_link;
        $template = $request->template;
        $username = $request->username;
        $password = $request->password;
        $color = "#ffffff";
        
        $data = DB::table('users')->where('username', '=', $username)->get();
        if(count($data) == 0){
            // insert in users
            DB::table('users')->insert([
                'username' => $username,
                'email' => $email_address,
                'password' => bcrypt($password)
            ]);
        }
        
        $data = DB::table('profile')->where('username', '=', $username)->get();
        if(count($data) == 0){
            // insert in profile
            DB::table('profile')->insert([
                'username' => $username,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'first_name' => $first_name,
                'avatar' => $image,
                'location' => $location,
                'interests' => $interests,
                'roles' => $roles,
                'spotlight' => $spotlight,
                'spotlight_link' => $spotlight_link,
                'template' => $template,
                'color' => $color
            ]);
            $response = array('result'=>true, 'A user added!');
            return json_encode($response);
        }

        if(count($data) >= 1){
            $response = array('result'=>false, 'A user already exist!');
            return json_encode($response);
        }
        
    }

    public function getProfile(Request $request)
    {
        $username = $request->username;
        $data = DB::table('profile')->where('username', '=', $username)->get();
        return json_encode($data);
    }

    public function getExtraInfo(Request $request)
    {
        $username = $request->username;
        $data = DB::table('extrainfo')->where('username', '=', $username)->get();
        return json_encode($data);
    }

    public function updateDescription(Request $request)
    {
        $username = $request->username;
        $description = $request->description;
        $record = [
            'username' => $username,
            'description' => $description
        ];
        $data = DB::table('description')->where('username', '=', $username)->get();
        
        if(count($data) == 0){
            DB::table('description')->insert([
                'username' => $username,
                'description' => $description
            ]);
        } else{
            DB::table('description')->where('username', '=', $username)->update(array('description' => $description));
        }
        return json_encode($record);
    }

    function updateDesign(Request $request){
        $username = $request->username;
        $template = $request->template;
        $color = $request->color;
        DB::table('profile')->where('username', '=', $username)->update(array('template' => $template, 'updated_at' => date('Y-m-d H:i:s')));
        $data = DB::table('extrainfo')->where([
            ['username', '=', $username],
            ['key', '=', 'color'],
        ])->get();
        if(count($data) == 0){
            DB::table('extrainfo')->insert([
                'username' => $username,
                'key' => 'color',
                'value' => $color,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            DB::table('extrainfo')->where([
                ['username', '=', $username],
                ['key', '=', 'color'],
            ])->update(array('value' => $color, 'updated_at' => date('Y-m-d H:i:s')));
        }
        return json_encode(['data'=> "Success"]);
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
