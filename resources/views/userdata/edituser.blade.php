@extends('layouts.main')

@section('container')
    <div class="p-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 font-weight-bold text-primary">Edit User</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="list-group">
                    <form method="post" action="{{ route('updateuser', $user->id) }}">
                    @csrf
                        <div class="mb-3">
                            <label for="namaKegiatan" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan Username" value="{{$user->username}}" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="tanggalKegiatan" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukan Email" value="{{$user->email}}" name="email">
                        </div>
                        <label for="tanggalKegiatan" class="form-label">Bidang</label>
                            <select class="form-select" aria-label="Default select example" name="bidang"">
                                <option value="{{$user->bidang}}" >{{$user->bidang}}</option>
                                <option value="admin" >admin</option>
                                <option value="dinas">Kepala dinas</option>
                                <option value="paud">Bidang PAUD</option>
                                <option value="sdsmp">Bidang SD & SMP</option>
                                <option value="gtk">Bidang GTK</option>
                                <option value="pdk">Publikasi Dan Komunikasi</option>
                            </select>

                            <div class="card-footer">
                
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>

    <div class="p-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 font-weight-bold text-primary">Edit Password User</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="list-group">
                    <form method="post" action="{{ route('updatepass', $user->id) }}">
                    @csrf
                        <div class="mb-3">
                            <label for="tanggalKegiatan" class="form-label">password</label>
                            <input type="text" class="form-control" id="bidang" placeholder="Masukan password" name="password">
                        </div>

                            <div class="card-footer">
                
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>

@endsection