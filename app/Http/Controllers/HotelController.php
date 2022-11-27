<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data = Hotel::all();
        return $data;
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
        $table = Hotel::create([
            "jenis_kamar" => $request->jenis_kamar,
            "fasilitas_kamar" => $request->fasilitas_kamar,
            "jumlah_orang" => $request->jumlah_orang,
            "harga_kamar" => $request->harga_kamar

        ]);

        return response()->json([
            'success'=> 201,
            'message'=> 'data kamar berhasil disimpan',
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
        //menampilkan data hotel
        $Hotel = Hotel::find($id);
        if ($Hotel) {
            return response()->json([
                'status' => 200,
                'data' => $Hotel
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
    //'jenis kamar', 'fasilitas kamar', 'jumlah orang', 'harga kamar'
    public function update(Request $request, $id)
    {

        $hotel = hotel::find($id);
        if($hotel){
            $hotel->jenis_kamar = $request->jenis_kamar ? $request->jenis_kamar : $Hotel->jenis_kamar;
            $hotel->fasilitas_kamar = $request->fasilitas_kamar ? $request->fasilitas_kamar : $Hotel->fasilitas_kamar;
            $hotel->jumlah_orang = $request-> jumlah_orang? $request->jumlah_orang: $Hotel->jumlah_orang;
            $hotel->harga_kamar = $request->harga_kamar? $request->harga_kamar : $Hotel->harga_kamar;
            $hotel->save();
            return response()->json([
                'status' => 200,
                'data' => $hotel,
                'message' => 'data kamar berhasil di update'
            ],200);
        } else{
            return response()->json([
                'status' => 400,
                'message' => $id . 'data kamar tidak ditemukan'   
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
        $hotel = Hotel::where('id',$id )->first();
        if($hotel){
            $hotel->delete();
            return response()->json([
                'status' => 200,
                'data' => $hotel,
                'message' => 'data kamar berhasil di hapus '
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' =>'id ' . $id . ' data kamar tidak ditemukan'
            ],404); 
    }
}
}
