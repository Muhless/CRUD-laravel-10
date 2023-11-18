<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mahasiswas::orderBy('nim', 'asc')->get();
        return view('page.index')->with('mahasiswa', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nim',$request->nim);
        Session::flash('nama',$request->nama);
        Session::flash('jurusan',$request->jurusan);

        $request->validate([
            'nim'=>'required|numeric|unique:mahasiswas,nim',
            'nama'=>'required',
            'jurusan'=>'required',
        ],[
            'nim.required'=>'NIM wajib diisi',
            'nim.numeric'=>'NIM wajib dalam angka',
            'nim.unique'=>'NIM yang diisikan sudah ada dalam database',
            'nama.required'=>'Nama wajib diisi',
            'jurusan.required'=>'Jurusan wajib diisi'
        ]);

        $data = [
        'nim'       =>$request->nim,
        'nama'      =>$request->nama,
        'jurusan'   =>$request->jurusan
    ];
    Mahasiswas::create($data);
    return redirect()->to('mahasiswa')->with('success', 'Berhasil menambahkan data');
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
}
