<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = DB::table('barang')->get();

        return view('barang.index')->with([
            'barang'  => $data,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'harga' => 'required',
        ]);

        DB::table('barang')->insert($validate);

        return redirect()->route('barang.index')->with('pesan', 'Barang Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);

        $data = DB::table('barang')->where('id', $id)->first();

        return view('barang.show')->with([
            'data' => $data,
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);

        $data = DB::table('barang')->where('id', $id)->first();

        return view('barang.edit')->with([
            'data' => $data,
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'harga' => 'required',
        ]);
        
        DB::table('barang')->where('id', decrypt($id))->update($validate);

        return redirect()->route('barang.index')->with('pesan', 'Barang Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('barang')->where('id', decrypt($id))->delete();

        return redirect()->route('barang.index')->with('pesan', 'Barang Berhasil Dihapus!');
    }
}
