@extends('layouts.main')

@section('container')
<div class="container-fluid">
    @if(session()->has('success'))
    <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="mt-1 alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Breadcrumb -->
    <div aria-label="breadcrumb">
        <ol class="p-3 breadcrumb bg-light">
            <li class="breadcrumb-item">
                <a href="/" class="text-dark text-decoration-none">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active text-dark" aria-current="page">Data Laporan PAUD</li>
        </ol>
    </div>

    <!-- Main Content -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">Data Laporan Kegiatan PAUD</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach ($kegiatans as $kegiatan)
                <div class="mb-3 list-group-item d-flex justify-content-between align-items-center border-left-primary">
                    <div>
                        <h5>{{ $kegiatan->nama_kegiatan }}</h5>
                        <p>Lokasi: {{ $kegiatan->lokasi_kegiatan }}</p>
                        <p>Tanggal: {{ $kegiatan->tanggal_kegiatan }}</p>
                    </div>
                    <div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#uploadModal-{{ $kegiatan->id_kegiatan }}">
                            <i class="fas fa-upload"></i>
                        </button>
                        <form method="post" action="{{ route('deleteFolderByName', $kegiatan->nama_kegiatan) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="bidang" value="PAUD">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Modal Upload -->
                <div class="modal fade" id="uploadModal-{{ $kegiatan->id_kegiatan }}" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id_kegiatan }}">
                                    <div class="form-group">
                                        <label for="id_kategori">Kategori</label>
                                        <select name="id_kategori" class="form-control" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_laporan">Nama Laporan</label>
                                        <input type="text" name="nama_laporan" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="uploadFile">File</label>
                                        <input type="file" name="uploadFile" class="form-control" required>
                                    </div>
                                    <input type="hidden" name="bidang" value="PAUD">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataLabel">Tambah Data Kegiatan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('datalaporanpaud.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal_kegiatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                            <input type="text" name="lokasi_kegiatan" class="form-control" required>
                        </div>
                        <input type="hidden" name="bidang" value="PAUD">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
