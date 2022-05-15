@extends('layouts.panel')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Profile Pengguna</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Pengguna</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section id="content-types">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="border-end mb-2">
                                                <h3 class="">
                                                    NAMA PENGGUNA
                                                </h3>
                                                <h6 class="text-muted">Divisi</h6>
                                                <small class="text-muted">Jabatan</small>
                                                <div class="text-muted">NIK :</div>
                                                <div class="text-muted">Tanggal masuk</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div>
                                                <ul class="">
                                                    <li>
                                                        <div class="title">No.TLp:</div>
                                                        <div class="text"><a href=""></a></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Email:</div>
                                                        <div class="text"><a href=""></a></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Birthday:</div>
                                                        <div class="text"></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Alamat:</div>
                                                        <div class="text"></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Jenis Kelamin:</div>
                                                        <div class="text"></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
