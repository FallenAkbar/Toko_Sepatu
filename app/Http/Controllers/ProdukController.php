<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Produk = Produk::all();

        return response()->json([
            "message" => "Data success",
            "data" => $Produk
        ], 200);
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
        $message = [
            "nama_merek" => "Masukan Nama Merek",
            "warna" => "Masukan Warna Sepatu",
            "size" => "Masukan Size Sepatu",
            "harga" => "Masukan Harga Sepatu",
        ];
        $validasi = Validator::make($request->all(), [
            "nama_merek" => "required",
            "warna" => "required",
            "size" => "required",
            "harga" => "required",
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $produk1 = Produk::create($validasi->validate());
        $produk1->save();

        return response()->json([
            "message" => "load data success",
            "data" => $produk1
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
        $produk = Produk::find($id);
        if ($produk) {
            return $produk;
        } else {
            return ["message" => "Data tidak ditemukan"];
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
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        $produk->save();

        return $produk;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteproduk = Produk::find($id);
        if ($deleteproduk) {
            $deleteproduk->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Delete tidak ditemukan"];
        }
    }
}
