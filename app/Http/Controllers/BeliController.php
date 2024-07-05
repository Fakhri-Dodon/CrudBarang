<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('beli')
            ->select('beli.*', 'barang.name as namaBarang', 'barang.unit', 'barang.harga')
            ->join('barang', 'barang.id', 'beli.barang')
            ->get();

        return view('beli.index')->with([
            'beli'  => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = DB::table('barang')->get();

        return view('beli.create')->with([
            'barang'  => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getBarang(Request $request)
    {

        Log::info('Request Data:', $request->all()); // Log request data for debugging

        $id = $request->input('id');
        if (!$id) {
            return response()->json(['error' => 'ID is required'], 400);
        }
        
        $data = DB::table('barang')->where('id', $request->id)->first();
        
        $inputElement = "<input id='harga' type='number' class='form-control qty' value='". $data->harga ."'>";
        return response()->json(['barang' => $inputElement]);
        // echo "<input id='harga' type='number' class='form-control qty' value='". $data->harga ."'>";
        // echo $data->harga;

    }

}
