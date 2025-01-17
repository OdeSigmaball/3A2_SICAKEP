@extends('layouts.main')

@section('container')

@if($errors->any())
    <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error )
                <li>{{$error}}</li>
            @endforeach
        </ul>
      <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

    <div class="p-3">
        <div class="mb-4 shadow card">
            <div class="py-3 card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 font-weight-bold text-primary">Edit Kategori</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="list-group">
                    <form method="post" action="{{ route('editkategoris',$kategori->id_kategori) }}">
                    @csrf
                        <div class="mb-3">
                            <label for="namaKegiatan" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan nama kategori" value="{{$kategori->nama_kategori}}" name="nama_kategori">
                        </div>
                            <div class="card-footer">

                            <button type="button" class="btn btn-secondary">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>


@endsection
