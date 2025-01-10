@extends('layouts.main')

@section('container')
@if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="p-3">
        <div class="mb-4 shadow card">
            <div class="py-3 card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 font-weight-bold text-primary">Edit Profile User</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="list-group">
                    <form method="post" action="{{ route('profile.update.info') }}">
                    @csrf

                        <div class="mb-3">
                            <label for="tanggalKegiatan" class="form-label">name</label>
                            <input type="text" class="form-control" id="bidang" value="{{old('username',$users->username)}}" placeholder="Masukan password" name="username">
                        </div>

                        <div class="mb-3">
                            <label for="tanggalKegiatan" class="form-label">password</label>
                            <input type="text" class="form-control" id="email" value="{{old('email',$users->email)}}" placeholder="Masukan Email Baru" name="email">
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

    <div class="p-3">
        <div class="mb-4 shadow card">
            <div class="py-3 card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 font-weight-bold text-primary">Edit Password</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="list-group">
                    <form method="post" action="{{ route('profile.update.password') }}">
                    @csrf
                        <div class="mb-3">
                            <label for="crtpw" class="form-label">Password Sebelumnya</label>
                            <input type="text" class="form-control" id="crtpw" placeholder="Masukkan Password Sebelumnya" value="" name="current_password" @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pw" class="form-label">Password baru</label>
                            <input type="text" class="form-control" id="pw" placeholder="Masukan Email" value="" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="pw" class="form-label">Konfirmasi Password baru</label>
                            <input type="text" class="form-control" id="pw" placeholder="Masukan Email" value="" name="password_confirmation">
                        </div>
                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>





@endsection
