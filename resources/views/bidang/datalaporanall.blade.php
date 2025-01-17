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
    <div class="mb-1 shadow card">
        <div class="mr card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold text-primary">Filter</h4>
            </div>

            </div>
        <form action="{{ route('datalaporanall.index') }}" method="GET" class="p-3 mb-3 mr-0 ">

                <!-- Filter Bidang -->
                <!-- Form Filter -->

            <div class="row">
                <!-- Filter Bulan -->
                <div class="col-md-3">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="">Semua Bulan</option>
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tahun -->
                <div class="col-md-3">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">Semua Tahun</option>
                        @foreach (range(now()->year, now()->year - 10) as $y)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tanggal -->
                <div class="col-md-3">
                    <label for="tanggal">Tanggal</label>
                    <select name="tanggal" id="tanggal" class="form-control">
                        <option value="">Semua Tanggal</option>
                        @foreach (range(1, 31) as $d)
                            <option value="{{ $d }}" {{ $tanggal == $d ? 'selected' : '' }}>
                                {{ $d }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Bidang -->
                <div class="col-md-3">
                    <label for="bidang">Bidang</label>
                    <select name="bidang" id="bidang" class="form-control">
                        <option value="">Semua Bidang</option>
                        <option value="GTK" {{ $bidang == 'GTK' ? 'selected' : '' }}>Guru dan Kependidikan</option>
                        <option value="PAUD" {{ $bidang == 'PAUD' ? 'selected' : '' }}>Pendidikan Anak Usia Dini</option>
                        <option value="PUBKOM" {{ $bidang == 'PUBKOM' ? 'selected' : '' }}>Publikasi DOkumentasi</option>
                        {{-- <option value="SEKDIS" {{ $bidang == 'PUBKOM' ? 'selected' : '' }}>Sekretariat Dinas</option> --}}
                        <option value="SD_SMP" {{ $bidang == 'PUBKOM' ? 'selected' : '' }}>Sekolah Dasar dan Menengah</option>
                    </select>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-end align-items-end">
                <button type="submit" class="mt-0 btn btn-primary d-flex align-items-end">Filter</button>
                </div>
        </form>
    </div>
</div>

<div class="p-3">
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold text-primary">Data Semua Kegiatan</h4>
            </div>
            <!-- Filter Bidang -->

        </div>

        <div class="card-body">
            <div class="list-group">

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">nama kegiatan</th>
                        <th scope="col">Lokasi kegiatan</th>
                        <th scope="col">Bidang</th>
                        <th scope="col">user yang mengunggah</th>
                        <th scope="col">dibuat</th>

                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $k )
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                        <td>{{$k->nama_kegiatan}}</td>
                        <td>{{$k->lokasi_kegiatan}}</td>
                        <td>{{$k->bidang}}</td>
                        <td>{{$k->user_upload}}</td>
                        <td>{{$k->created_at}}</td>

                        <td>



                            <form class="p-0 m-0 btn btn-primar" method="POST" action="{{route('laporan.show',$k->id_kegiatan)}}">
                                @csrf
                                <button type="submit" class="mr-3 btn btn-primary">Detail</i></button>
                            </form>

                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>

            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $kegiatan->links() }}
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
