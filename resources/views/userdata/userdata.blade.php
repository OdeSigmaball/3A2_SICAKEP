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
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">last update</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $u )
                        <tr>
                        <th scope="row">1</th>
                        <td>{{$u->username}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->bidang}}</td>
                        
                        <td>
                            <a href="{{route('edituser',$u->id)}}" class="mr-3 btn btn-primary">
                            <i class="fas fa-edit"></i>
                            </a>


                                <a href="" onclick="return confirm('Apakah anda yakin?')">
                            <form class="p-0 m-0 btn btn-danger" method="post" action="{{route('deleteuser',$u->id)}}">
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
                <form action="{{ route('storeuser') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukan Email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="tanggalKegiatan" class="form-label">Password</label>
                        <input type="password" class="form-control" id="bidang" placeholder="Masukan Password" name="password">
                    </div>
                    <label for="tanggalKegiatan" class="form-label">Bidang</label>
                    <select class="form-select" aria-label="Default select example" name="bidang">
                        <option value="admin" selected>admin</option>
                        <option value="dinas">Kepala dinas</option>
                        <option value="paud">Bidang PAUD</option>
                        <option value="sdsmp">Bidang SD & SMP</option>
                        <option value="gtk">Bidang GTK</option>
                        <option value="pdk">Publikasi Dan Komunikasi</option>
                    </select>
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
