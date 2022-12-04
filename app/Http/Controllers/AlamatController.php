<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Alamat = Alamat::all();

        return response()->json([
            "message" => "Data success",
            "data" => $Alamat
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
            "Desa" => "Masukan Nama Desa",
            "Kecamatan" => "Masukan Nama Kecamatan",
            "Kabupaten" => "Masukan Nama Kabupaten",
            "kode_pos" => "Masukan Kode Pos",
        ];
        $validasi = Validator::make($request->all(), [
            "Desa" => "required",
            "Kecamatan" => "required",
            "Kabupaten" => "required",
            "Kode_pos" => "required",
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $Alamat = Alamat::create($validasi->validate());
        $Alamat->save();

        return response()->json([
            "message" => "Data success",
            "data" => $Alamat
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
        $Alamat = Alamat::find($id);
        if ($Alamat) {
            return $Alamat;
        } else {
            return ["message" => "Data tidak ada"];
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
        $Alamat3 = Alamat::findOrFail($id);
        $Alamat3->update($request->all());
        $Alamat3->save();

        return $Alamat3;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteAlamat = Alamat::find($id);
        if ($deleteAlamat) {
            $deleteAlamat->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Data tidak ada"];
        }
    }
}
