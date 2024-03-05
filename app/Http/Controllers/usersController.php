<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class usersController extends Controller
{
    public function register(Request $request){
// validation

$request->validate([

    "name"     => "required",
    "email"    => "required|email|unique:users",
    "password" => "required|confirmed"
]);

// create data
$user = new User();
$user->name=$request->name;
$user->email=$request->email;
$user->password=bcrypt($request->password);
$user->save();
return response([ 'status' => 1, 'message' => 'created successfully']);

//save date and send response

    }
    public function login(Request $request)
    {
        // validation
        $login_data = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        // validate user data
        if(!auth()->attempt($login_data)){

            return response()->json([
                "status" => false,
                "message" => "Invalid Credentials"
            ]);
        }

        // token
        $token = auth()->user()->createToken("auth_token")->accessToken;

        // send response
        return response()->json([
            "status" => true,
            "message" => "user Logged in successfully",
            "access_token" => $token
        ]);
    }
    public function profile()
    {
        $user_data = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "User data",
            "data" => $user_data
        ]);
    }
    // LOGOUT METHOD - POST
    public function logout(Request $request)
    {
        // get token value
        $token = $request->user()->token();

        // revoke this token value
        $token->revoke();

        return response()->json([
            "status" => true,
            "message" => "user logged out successfully"
        ]);
    }
}
