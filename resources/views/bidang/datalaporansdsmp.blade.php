@extends('layouts.main')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Breadcrumbs -->
<div aria-label="breadcrumb">
    <ol class="p-3 breadcrumb bg-light">
        <li class="breadcrumb-item">
            <a href="/" class="text-dark text-decoration-none"><i class="fas fa-home text-dark"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active text-dark" aria-current="page">
            <i class="fas fa-database"></i> <a href="index.html" class="text-dark text-decoration-none">Data Laporan</a>
        </li>
    </ol>
</div>
<!-- Breadcrumbs ENDs -->


<!-- Main Content -->
<div class="mb-4 shadow card">
    <div class="py-3 card-header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="m-0 font-weight-bold text-primary">Data Laporan Kegiatan</h4>
            <h4 class="font-weight-normal text-dark">Bidang SD & SMP</h4>
        </div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
    </div>
    <div class="card-body">
        <div class="list-group">
            <!-- Item 1 -->
            <div class="mb-3 list-group-item d-flex justify-content-between align-items-center border-left-primary">
                <div>
                    <h5>Kegiatan 1</h5>
                    <p class="mb-0">Lokasi: <span class="text-muted">Lokasi 1</span></p>
                    <p class="mb-0">Tanggal: <span class="text-muted">12-12-2024</span></p>
                </div>
                <div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                        <i class="fas fa-upload"></i>
                    </button>
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </div>
            </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        <i class="fas fa-upload"></i>
                    </button>
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content END -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataLabel">Form Input Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="namaKegiatan" class="form-label">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="namaKegiatan" placeholder="Masukkan nama kegiatan">
                    </div>
                    <div class="mb-3">
                        <label for="tanggalKegiatan" class="form-label">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" id="tanggalKegiatan">
                    </div>
                    <div class="mb-3">
                        <label for="lokasiKegiatan" class="form-label">Lokasi Kegiatan</label>
                        <input type="text" class="form-control" id="lokasiKegiatan" placeholder="Masukkan lokasi kegiatan">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="bidang" name="bidang" value="GTK" placeholder="Masukkan bidang kegiatan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="uploadFile" class="form-label">Pilih File</label>
                        <input type="file" class="form-control" id="uploadFile" name="uploadFile">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiFile" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiFile" rows="3" placeholder="Masukkan deskripsi file"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection
