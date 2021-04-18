<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        // $search = request()->query('search');
        // if($search) {
        //     $posts = Mahasiswa::where('nama', 'LIKE', "%{$search}%")->paginate(5);
        // } else {
        //     $posts = Mahasiswa::orderBy('nim', 'asc')->paginate(5);
        // }
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel 
        // $posts = Mahasiswa::orderBy('nim', 'asc')->paginate(5); 
        $Mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('nim', 'asc')->paginate(3);
        return view('users.index', ['mahasiswa' => $Mahasiswa, 'paginate' => $paginate]); 
        // dd($paginate);
        // return view('users.index', compact('posts')); 
        // with('i', (request()->input('page', 1) - 1) * 5);
    }


    // public function create()
    // {
    //     return view('users.create');
    // }

    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('users.create', ['kelas' => $kelas]);
    }



    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([ 
            'nim' => 'required', 
            'nama' => 'required', 
            'kelas_id' => 'required', 
            'jurusan' => 'required', 
            'email' => 'required', 
            'no_tlp' => 'required', 
            'tgl_lahir' => 'required', 
            ]);

            //fungsi eloquent untuk menambah data
            // Mahasiswa::create($request->all());
            
            $Mahasiswa = new Mahasiswa;
            $Mahasiswa->nim = $request->get('nim');
            $Mahasiswa->nama = $request->get('nama');
            $Mahasiswa->jurusan = $request->get('jurusan');
            $Mahasiswa->email = $request->get('email');
            $Mahasiswa->no_tlp = $request->get('no_tlp');
            $Mahasiswa->tgl_lahir = $request->get('tgl_lahir');
            
            $kelas = new Kelas;
            $kelas->id = $request->get('kelas_id');

             //fungsi eloquent untuk menambah data dengan relasi belongsTo
            $Mahasiswa->kelas()->associate($kelas);
            $Mahasiswa->save();
            
            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');

            // dd($mahasiswa);
    }

    
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        // $Mahasiswa = Mahasiswa::find($nim); 
        // return view('users.detail', compact('Mahasiswa'));

        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        return view('users.detail', ['Mahasiswa' => $Mahasiswa]);
    }

    public function detailKhs($nim) {
        $Mahasiswa = Mahasiswa::with('kelas', 'matakuliah')->where('nim', $nim)->first();
        return view('users.detailKhs', compact('Mahasiswa'));
    }

    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        // $Mahasiswa = Mahasiswa::find($nim); 
        // return view('users.edit', compact('Mahasiswa'));

        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $kelas = Kelas::all();
        return view('users.edit', compact('Mahasiswa', 'kelas'));
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

            $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
            $Mahasiswa->nim = $request->get('nim');
            $Mahasiswa->nama = $request->get('nama');
            $Mahasiswa->jurusan = $request->get('jurusan');
            $Mahasiswa->email = $request->get('email');
            $Mahasiswa->no_tlp = $request->get('no_tlp');
            $Mahasiswa->tgl_lahir = $request->get('tgl_lahir');
            $Mahasiswa -> save();

            $kelas = new Kelas;
            $kelas->id =$request->get('kelas');

            // fungsi eloquent untuk mengupdate data dengan relasi belongsTo
            $Mahasiswa->kelas()->associate($kelas);
            $Mahasiswa -> save();
            
            //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index') 
                ->with('success', 'Mahasiswa Berhasil Diupdate');

            //fungsi eloquent untuk mengupdate data inputan kita 
            // Mahasiswa::find($nim)->update($request->all());

    }

    
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete(); 
        return redirect()->route('mahasiswa.index') 
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
}