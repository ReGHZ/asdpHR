<header class="mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item dropdown me-2">
                        <a class="dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manajer'))
                                <i class='bi bi-bell bi-sub fs-4'></i><span
                                    class="position-absolute top-0 start-99 translate-middle badge rounded-pill bg-danger">
                                    {{ Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifCuti')->count() }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                            @if (Auth::user()->hasRole('user'))
                                <i class='bi bi-bell bi-sub fs-4'></i><span
                                    class="position-absolute top-0 start-99 translate-middle badge rounded-pill bg-danger">
                                    {{ Auth::user()->unreadnotifications->whereIn('type', ['App\Notifications\NotifTolakCuti', 'App\Notifications\NotifTerimaCuti'])->count() }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manajer'))
                                <li>
                                    <a href="{{ route('pengajuan-cuti.mark-all') }}"
                                        class="dropdown-header btn icon btn-sm btn-success me-2 ms-2"><i
                                            class="bi bi-check"></i>
                                        Tandai
                                        Terbaca Semua</a>
                                </li>

                                @foreach (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifCuti') as $notification)
                                    <li><a href="{{ route('pengajuan-cuti.mark-notif', $notification->id) }}"
                                            class="dropdown-item">{{ $notification->data['user_name'] }}
                                            mengajukan {{ $notification->data['jenis_cuti'] }} selama
                                            {{ $notification->data['lama_hari'] }} hari</a> </li>
                                @endforeach
                            @endif

                            @if (Auth::user()->hasRole('user'))
                                <li>
                                    <a href="{{ route('pengajuan-cuti.mark-all') }}"
                                        class="dropdown-header btn icon btn-sm btn-success me-2 ms-2"><i
                                            class="bi bi-check"></i>
                                        Tandai
                                        Terbaca Semua</a>
                                </li>

                                @foreach (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifTolakCuti') as $notification)
                                    <li><a href="" class="dropdown-item">Pengajuan Cuti Anda Ditolak</a> </li>
                                @endforeach
                                @foreach (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifTerimaCuti') as $notification)
                                    <li><a href="" class="dropdown-item">Pengajuan Cuti Anda Diterima</a> </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                    <p class="mb-0 text-sm text-gray-600">
                                        {{ Auth::user()->jabatan->nama_jabatan }}</p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    @if (isset(Auth::user()->pegawai->foto))
                                        <div class="avatar avatar-md">
                                            <img src="{{ asset('fotoPegawai/' . Auth::user()->pegawai->foto) }}">
                                        </div>
                                    @else
                                        <div class="avatar avatar-md">
                                            <img src="{{ asset('backend/assets/images/faces/2.jpg') }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                            style="min-width: 11rem;">
                            <li>
                                <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                        class="icon-mid bi bi-person me-2"></i> Lihat
                                    Profile</a></li>
                            <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </ol>
            </nav>
        </div>
    </div>
</header>
