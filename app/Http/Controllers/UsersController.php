<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('users')->get();
        return view('user.index')->with([
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $validate['password'] = Hash::make($request['password']);

        DB::table('users')->insert($validate);

        return redirect()->route('user.index')->with('pesan', 'User Berhasil Ditambahkan!');
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
        $id = decrypt($id);

        $data = DB::table('users')->where('id', $id)->first();

        return view('user.edit')->with([
            'data' => $data,
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $id = decrypt($id);

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8',
        ]);
        
        if (!empty($validate['password'])) {
            $validate['password'] = Hash::make($validate['password']);
        } else {
            unset($validate['password']);
        }
        
        User::where('id', $id)->update($validate);

        return redirect()->route('user.index')->with('pesan', 'Barang Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', decrypt($id))->delete();

        return redirect()->route('user.index')->with('pesan', 'User Berhasil Dihapus!');
    }
}
