@extends('layouts.panel')
@section('css')
    <style>
        .welcome-box {
            background-color: #fff;
            border-bottom: 1px solid #ededed;
            display: flex;
            padding: 20px;
            position: relative;
        }

        .welcome-img {
            margin-right: 15px;
        }

        .welcome-img img {
            border-radius: 8px;
            width: 60px;
        }

        .welcome-det p {
            color: #777;
            font-size: 18px;
            margin-bottom: 0;
        }
    </style>
@endsection
@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-md-12">
                @if (isset(Auth::user()->pegawai->foto))
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img src="{{ asset('fotoPegawai/' . Auth::user()->pegawai->foto) }}"
                                alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Selamat Datang, {{ Auth::user()->name }}</h3>
                            <p>{{ $todayDate }}</p>
                        </div>
                    </div>
                @else
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img src="{{ asset('backend/assets/images/faces/2.jpg') }}" alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, {{ Auth::user()->name }}</h3>
                            <p>{{ $todayDate }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manajer'))
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="fas fa-suitcase-rolling"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pengajuan Cuti</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pengajuanCuti->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-plane"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Perjalanan Dinas</h6>
                                    <h6 class="font-extrabold mb-0">183.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pegawai</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pegawai->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="fas fa-suitcase-rolling"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pengajuan Cuti</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ Auth::user()->pengajuanCuti->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Cuti Diterima</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ Auth::user()->pengajuanCuti->where('status', 'Disetujui')->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Cuti Ditolak</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ Auth::user()->pengajuanCuti->where('status', 'Ditolak')->count() }}</h6>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-plane"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Perjalanan Dinas</h6>
                                    <h6 class="font-extrabold mb-0">183.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection
