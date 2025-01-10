@extends('layouts.main')

@section('container')

   <div class="mt-3 mb-3">
   @if(session()->has('success'))
        <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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

   </div>
<div class="p-3">
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold text-primary">Data User</h4>
            </div>
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <div class="card-body">
            <div class="list-group">

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">pembaruan terakhir</th>
                        <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $k )
                        <tr>
                        <th scope="row">1</th>
                        <td>{{$k->nama_kategori}}</td>
                        
                        <td>
                            <a href="{{route('editkategori',$k->id_kategori)}}" class="mr-3 btn btn-primary">
                            <i class="fas fa-edit"></i>
                            </a>


                                <a href="" onclick="return confirm('anda yakin mau menghapus data?')">
                            <form class="p-0 m-0 btn btn-danger" method="post" action="{{route('deletekategori',$k->id_kategori)}}">
                                @csrf
                                <button type="submit" class="mr-3 btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                            </a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>

            </div>

        </div>
    </div>
</div>
<!-- Begin Page Content End -->

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUserLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storekategori') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori" placeholder="Masukkan kategori" name="namakategori">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



@endsection
