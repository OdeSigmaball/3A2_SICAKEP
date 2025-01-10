@extends('layouts.main')

@section('container')

<div class="container-fluid">
                    <div class="title-section text-center mt-5 mb-4">
                        <img src="../images/Logo BPMP.png" alt="Logo BPMP" class="w-10">
                        <img src="../images/Logo Dinas Pendidikan Kabupaten Bangli.png" alt="Logo Dinas" class="w-10">
                        <img src="../images/Logo Tut Wuri Handayani.png" alt="Logo Tut Wuri Handayani" class="w-10">
                        <h3 class="font-weight-bold">Sistem Informasi Capaian Kinerja Kepegawaian dan Realisasi Program</h3>
                        <p>Dinas Pendidikan Kabupaten Bangli</p>
                    </div>

                    <div class="mt-5">
                        <!-- Wrap the cards with a flex container -->
                        <div class="d-flex flex-wrap justify-content-around">
                            <a href="/bidang/datalaporanpaud" class="card text-decoration-none mt-3" style="width: 25rem;">
                                <img src="../images/paud.jpg" class="card-img-top h-50" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bidang PAUD</h5>
                                    <p class="card-text">PAUD fokus pada perkembangan anak usia dini melalui pendidikan dan stimulasi.</p>
                                </div>
                            </a>
                            <a href="/bidang/datalaporansdsmp" class="card text-decoration-none mt-3" style="width: 25rem;">
                                <img src="../images/sd&smp.jpg" class="card-img-top h-50" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bidang SD & SMP</h5>
                                    <p class="card-text">Pendidikan dasar mengembangkan karakter, pengetahuan, keterampilan, dan nilai siswa.</p>
                                </div>
                            </a>
                            <a href="/bidang/datalaporangtk" class="card text-decoration-none mt-3" style="width: 25rem;">
                                <img src="../images/guru.jpg" class="card-img-top h-50" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bidang GTK</h5>
                                    <p class="card-text">Mengelola guru dan tenaga kependidikan untuk meningkatkan mutu pendidikan.</p>
                                </div>
                            </a>
                            <a href="/bidang/datalaporanpubkom" class="card text-decoration-none mt-3" style="width: 25rem;">
                                <img src="../images/publikasi.jpg" class="card-img-top h-50" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Publikasi & Komunikasi</h5>
                                    <p class="card-text">Menyampaikan informasi penting secara efektif untuk menjangkau khalayak luas.</p>
                                </div>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

    

@endsection