@extends('users.layout') 
@section('content') 
<div class="container mt-5">
    <div class="row justify-content-center align-items-center"> 
        <div class="card" style="width: 24rem;">
            <div class="card-header"> 
                Tambah Mahasiswa 
            </div> 
            <div class="card-body"> 
                @if ($errors->any()) 
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul> 
                        @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                        @endforeach 
                    </ul>
                </div> 
                @endif 
                <form method="post" action="{{ route('mahasiswa.store') }}" id="myForm">
                    @csrf
                    <div class="form-group"> 
                        <label for="nim">Nim</label> 
                        <input type="text" name="nim" class="form-control" id="nim" aria-describedby="nim" > 
                    </div>
                    <div class="form-group"> 
                        <label for="nama">Nama</label> 
                        <input type="text" name="nama" class="form-control" id="nama" aria-describedby="nama" > 
                    </div>
                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" class="form-control select2">
                            @foreach ($kelas as $kls)
                                <option value="{{$kls->id}}" {{ old('kelas_id') == "$kls->id" ? 'selected' : '' }}>{{$kls->nama_kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"> 
                        <label for="jurusan">Jurusan</label> 
                        <input type="text" name="jurusan" class="form-control" id="jurusan" aria-describedby="jurusan" > 
                    </div>
                    <div class="form-group"> 
                        <label for="email">E-mail</label> 
                        <input type="text" name="email" class="form-control" id="email" aria-describedby="email" > 
                    </div>
                    <div class="form-group"> 
                        <label for="no_tlp">No_Handphone</label> 
                        <input type="text" name="no_tlp" class="form-control" id="no_tlp" aria-describedby="no_tlp" > 
                    </div>
                    <div class="form-group"> 
                        <label for="no_tlp">Tgl_Lahir</label> 
                        <input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" aria-describedby="tgl_lahir" > 
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button> 
                </form> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection
