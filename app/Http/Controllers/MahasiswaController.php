<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $search = request()->query('search');
        if($search) {
            $posts = Mahasiswa::where('nama', 'LIKE', "%{$search}%")->paginate(5);
        } else {
            $posts = Mahasiswa::orderBy('nim', 'asc')->paginate(5);
        }
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel 
        // $posts = Mahasiswa::orderBy('nim', 'asc')->paginate(5); 
        return view('users.index', compact('posts')); 
        with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([ 
            'nim' => 'required', 
            'nama' => 'required', 
            'kelas' => 'required', 
            'jurusan' => 'required', 
            'email' => 'required', 
            'no_tlp' => 'required', 
            'tgl_lahir' => 'required', 
            ]);

            //fungsi eloquent untuk menambah data
            Mahasiswa::create($request->all());

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index') 
                ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($nim); 
        return view('users.detail', compact('Mahasiswa'));
    }


    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($nim); 
        return view('users.edit', compact('Mahasiswa'));
    }


    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $request->validate([ 
            'nim' => 'required', 
            'nama' => 'required', 
            'kelas' => 'required', 
            'jurusan' => 'required', 
            'email' => 'required', 
            'no_tlp' => 'required', 
            'tgl_lahir' => 'required', 
            ]);

        //fungsi eloquent untuk mengupdate data inputan kita 
            Mahasiswa::find($nim)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index') 
                ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete(); 
        return redirect()->route('mahasiswa.index') 
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
}