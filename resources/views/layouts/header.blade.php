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
                            @role('admin|manajer')
                                <i class='bi bi-bell bi-sub fs-4'></i><span
                                    class="position-absolute top-0 start-99 translate-middle badge rounded-pill bg-danger">
                                    {{ Auth::user()->unreadnotifications->whereIn('type', ['App\Notifications\NotifCuti', 'App\Notifications\NotifPenugasanDinas'])->count() }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endrole
                            @role('user')
                                <i class='bi bi-bell bi-sub fs-4'></i><span
                                    class="position-absolute top-0 start-99 translate-middle badge rounded-pill bg-danger">
                                    {{ Auth::user()->unreadnotifications->whereIn('type', ['App\Notifications\NotifTolakCuti', 'App\Notifications\NotifTerimaCuti', 'App\Notifications\NotifPenugasanDinas'])->count() }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endrole
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            @role('admin|manajer')
                                <li>
                                    <a href="{{ route('notifications.mark-all') }}"
                                        class="dropdown-header btn icon btn-sm btn-success me-2 ms-2"><i
                                            class="bi bi-check"></i>
                                        Tandai
                                        Terbaca Semua</a>
                                </li>

                                @foreach (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifCuti') as $notification)
                                    <li><a href="{{ route('notifications.mark-notif', $notification->id) }}"
                                            class="dropdown-item">{{ $notification->data['user_name'] }}
                                            mengajukan {{ $notification->data['jenis_cuti'] }} selama
                                            {{ $notification->data['lama_hari'] }} hari</a> </li>
                                @endforeach
                                @foreach (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifPenugasanDinas') as $notification)
                                    <li><a class="dropdown-item">Ada penugasan masuk<br>Perlu membuat RAB perjalanan
                                            dinas</a> </li>
                                @endforeach
                            @endrole

                            @role('user')
                                <li>
                                    <a href="{{ route('notifications.mark-all') }}"
                                        class="dropdown-header btn icon btn-sm btn-success me-2 ms-2"><i
                                            class="bi bi-check"></i>
                                        Tandai
                                        Terbaca Semua</a>
                                </li>

                                @foreach (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifTolakCuti') as $notification)
                                    <li><a class="dropdown-item">Pengajuan Cuti Anda Ditolak</a> </li>
                                @endforeach
                                @foreach (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifTerimaCuti') as $notification)
                                    <li><a class="dropdown-item">Pengajuan Cuti Anda Diterima</a> </li>
                                @endforeach
                                @foreach (Auth::user()->unreadnotifications->where('type', 'App\Notifications\NotifPenugasanDinas') as $notification)
                                    <li><a class="dropdown-item">Anda Ditugaskan perjalanan dinas</a> </li>
                                @endforeach
                            @endrole
                        </ul>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>
