<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkout = Checkout::all();

        return response()->json([
            "message" => "Data load Success",
            "data" => $checkout
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
            "produk_id" => "Masukan produk id",
            "user_id" => "Masukan id user",
            "nama_merek" => "Masukan Nama Merek",
            "warna" => "Masukan warna",
            "size" => "Masukan Size",
            "harga" => "Masukan Harga",
            "Desa" => "Masukan Desa",
            "Kecamatan" => "Masukan Kecamatan",
            "Kabupaten" => "Masukan Kabupaten",
            "Kode_pos" => "Masukan Kode pos",
            "hari" => "Masukan hari",
            "bulan" => "Masukan bulan",
            "tahun" => "Masukan tahun",
        ];
        $validasi = Validator::make($request->all(),[
            "produk_id" => "required",
            "user_id" => "required",
            "nama_merek" => "required",
            "warna" => "required",
            "size" => "required",
            "harga" => "required",
            "Desa" => "required",
            "Kecamatan" => "required",
            "Kabupaten" => "required",
            "Kode_pos" => "required",
            "hari" => "required",
            "bulan" => "required",
            "tahun" => "required",
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $checkout = Checkout::create($validasi->validate());
        $checkout->save();

        return response()->json([
            "message" => "load data success",
            "data" => $checkout
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
        $checkou = Checkout::find($id);
        if ($checkou) {
            return $checkou;
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
        $checkout = Checkout::findOrFail($id);
        $checkout->update($request->all());
        $checkout->save();

        return $checkout;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletcheckout = Checkout::find($id);
        if ($deletcheckout) {
            $deletcheckout->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Data tidak ada"];
        }
    }
}
