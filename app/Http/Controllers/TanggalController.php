<?php

namespace App\Http\Controllers;

use App\Models\Tanggal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TanggalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggal = Tanggal::all();

        return response()->json([
            "message" => "Data success",
            "data" => $tanggal
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
            "hari" => 'Masukan Hari',
            "bulan" => "Masukan Bulan",
            "tahun" => "Masukan Tahun",
            ];
        $validasi = Validator::make($request->all(), [
            "hari" => "required",
            "bulan" => "required",
            "tahun" => "required",
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $tanggal = Tanggal::create($validasi->validate());
        $tanggal->save();

        return response()->json([
            "message" => "Data success",
            "data" => $tanggal
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
        $tanggal = Tanggal::find($id);
        if ($tanggal) {
            return $tanggal;
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
        $tanggal = Tanggal::findOrFail($id);
        $tanggal->update($request->all());
        $tanggal->save();

        return $tanggal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Tanggal::find($id);
        if ($delete) {
            $delete->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Data tidak ditemukan"];
        }
    }
}
