<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
 
    
    public function register(Request $request){

        $field = $request->validate([
          'name' => 'required|string|max:100',
          'email' => 'required|string|unique:users,email',
          'password' => 'required|string|confirmed|min:8'
        ]);

        $user = User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' => bcrypt($field ['password'])
        ]);

        $token = $user->CreateToken('tokengw')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
           
        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' =>'required|string',
            'password' =>'required|string'
        ]);

        //check email 
        $user = User::where('email', $fields['email'])->first();

        //check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'unauthorized'
            ],401);
        }

        $token = $user->createToken('mytoken')->plainTextToken;

        $response =[
            'user' => $user,
            'token' => $token
        ];
        return response($response,201);
    }

    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}