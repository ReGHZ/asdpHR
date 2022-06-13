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
                    <li class="breadcrumb-item dropdown">
                        <a class="dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('user manajer'))
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
                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('user manajer'))
                                <li>
                                    <a href="{{ route('pengajuan-cuti.mark-all') }}"
                                        class="dropdown-header btn icon btn-sm btn-success"><i
                                            class="bi bi-check"></i>
                                        Tandai
                                        Terbaca Semua</a>
                                </li>

                                @forelse  (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifCuti') as $notification)
                                    <li><a href="{{ route('pengajuan-cuti.mark-notif', $notification->id) }}"
                                            class="dropdown-item">{{ $notification->data['user_name'] }}
                                            mengajukan {{ $notification->data['jenis_cuti'] }} selama
                                            {{ $notification->data['lama_hari'] }} hari</a> </li>
                                @empty
                                    <li>
                                        <a class="dropdown-item ">
                                            Belum ada pemberitahuan
                                        </a>
                                    </li>
                                @endforelse
                            @endif

                            @if (Auth::user()->hasRole('user'))
                                <li>
                                    <a href="" class="dropdown-header btn icon btn-sm btn-success"><i
                                            class="bi bi-check"></i>
                                        Tandai
                                        Terbaca Semua</a>
                                </li>

                                @forelse  (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifTolakCuti') as $notification)
                                    <li><a href="" class="dropdown-item">Pengajuan Cuti Anda Ditolak</a> </li>
                                @empty
                                    <li>
                                        <a class="dropdown-item ">
                                            Belum ada pemberitahuan
                                        </a>
                                    </li>
                                @endforelse
                            @endif
                        </ul>
                    </li>

                </ol>
            </nav>
        </div>
    </div>
</header>
