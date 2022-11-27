<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $table = User::create([
            "nama" => $request->nama,
            "email" => $request->email,
            "password" => $request->password
            
        ]);

        return response()->json([
            'success'=> 201,
            'message'=> 'data berhasil disimpan',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = user::find($id);
        if ($user) {
            return response()->json([
                'status' => 200,
                'data' => $user
            ], 200);

        } else {
            return response()->json([
                'status'=> 404,
                'message'=> 'id atas' .$id . 'tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $user = user::find($id);
        if($user){
            $user->nama = $request->nama ? $request->nama : $user->nama;
            $user->email = $request->email? $request->email : $user->email;
            $user->password = $request->password ? $request->password : $user->password;
            $user->save();
            return response()->json([
                'status' => 200,
                'data' => $user
            ],200);
        } else{
            return response()->json([
                'status' => 400,
                'message' => $id . ' tidak ditemukan'   
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = user::where('id',$id )->first();
        if($user){
            $user->delete();
            return response()->json([
                'status' => 200,
                'data' => $user
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' =>'id ' . $id . 'tidak ditemukan'
            ],404); 
    }
}
}