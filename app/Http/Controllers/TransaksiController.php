<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //menampilkan semuanya
    public function index()
    {
        $data = Transaksi::all();
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
    //'nama tamu hotel', 'email', 'jumlah orang', 'fasilitas kamar', 'tanggal reservasi', 'tanggal checkout', 'jumlah hari'
    //nambah
    public function store(Request $request)
    {
        $table = Transaksi::create([
            "nama_tamu_hotel" => $request->nama_tamu_hotel,
            "email" => $request->email,
            "jumlah_orang" => $request->jumlah_orang,
            "jenis_fasilitas_kamar"=>$request->jenis_fasilitas_kamar,
            "tanggal_reservasi"=>$request->tanggal_reservasi,
            "tanggal_check_out"=>$request->tanggal_check_out,
            "jumlah_hari" => $request->jumlah_hari

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
    //menampikan berdasarkan id atau tertentu
    public function show($id)
    {
        $Transaksi = transaksi::find($id);
        if ($hotel) {
            return response()->json([
                'status' => 200,
                'data' => $hotel,
               
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
    //'nama_tamu_hotel', 'email', 'jumlah_orang', 'fasilitas_kamar', 'tanggal_reservasi', 'tanggal_checkout', 'jumlah_hari'
    
    public function update(Request $request, $id)
    {
        $transaksi = transaksi::find($id);
        if($transaksi){
            $transaksi->nama_tamu_hotel = $request->nama_tamu_hotel ? $request->nama_tamu_hotel : $transaksi->nama_tamu_hotel;
            $transaksi->tanggal_reservasi = $request->tanggal_reservasi ? $request->tanggal_reservasi : $transaksi->tanggal_reservasi;
            $transaksi->tanggal_check_out = $request-> tanggal_check_out? $request->tanggal_check_out : $transaksi->tanggal_check_out;
            $transaksi->jumlah_orang = $request->jumlah_orang? $request->jumlah_orang : $transaksi->jumlah_orang;
            $transaksi->email = $request->email ? $request->email : $author->email;
            $transaksi->jumlah_hari = $request->jumlah_hari? $request->jumlah_hari: $transaksi->jumlah_hari;
            $transaksi->jenis_fasilitas_kamar = $request->jenis_fasilitas_kamar ? $request->jenis_fasilitas_kamar : $transaksi->jenis_fasilitas_kamar;
            $transaksi->save();
            return response()->json([
                'status' => 200,
                'data' => $transaksi,
                
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
        $transaksi = transaksi::where('id',$id )->first();
        if($transaksi){
            $transaksi->delete();
            return response()->json([
                'status' => 200,
                'message'=> 'data berhasil disimpan',
                'data' => $transaksi
                
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' =>'id ' . $id . 'tidak ditemukan'
            ],404); 
    }
}
}