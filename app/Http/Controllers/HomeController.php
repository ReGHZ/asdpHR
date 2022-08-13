<?php

namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use App\Models\Pengikut;
use App\Models\PerjalananDinas;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dt = Carbon::now();
        $todayDate = $dt->translatedFormat('j F Y h:i:s a');
        $pegawai = User::all();
        $pengajuanCuti = PengajuanCuti::all();
        $perjalananDinas = PerjalananDinas::all();

        //grafik masa kerja

        $groupsMasaKerja =
            [
                'Kurang dari 5 Tahun' =>  User::select('masa_kerja')
                    ->where('masa_kerja', '>=', 0)
                    ->where('masa_kerja', '<=', 5)
                    ->count(),

                '6 sampai 10 Tahun' => User::select('masa_kerja')
                    ->where('masa_kerja', '>=', 6)
                    ->where('masa_kerja', '<=', 10)
                    ->count(),

                'Lebih dari 11 Tahun' => User::select('masa_kerja')
                    ->where('masa_kerja', '>=', 11)
                    ->count(),
            ];

        // Prepare the data for returning with the view
        $grafikMasaKerja = new User;
        $grafikMasaKerja->labels = (array_keys($groupsMasaKerja));
        $grafikMasaKerja->dataset = (array_values($groupsMasaKerja));

        //grafik masa jabatan

        $groupsMasaJabatan =
            [
                'Kurang dari 5 Tahun' =>  User::select('masa_jabatan')
                    ->where('masa_jabatan', '>=', 0)
                    ->where('masa_jabatan', '<=', 5)
                    ->count(),

                '6 sampai 10 Tahun' => User::select('masa_jabatan')
                    ->where('masa_jabatan', '>=', 6)
                    ->where('masa_jabatan', '<=', 10)
                    ->count(),

                'Lebih dari 11 Tahun' => User::select('masa_jabatan')
                    ->where('masa_jabatan', '>=', 11)
                    ->count(),
            ];

        // Prepare the data for returning with the view
        $grafikMasaJabatan = new User;
        $grafikMasaJabatan->labels = (array_keys($groupsMasaJabatan));
        $grafikMasaJabatan->dataset = (array_values($groupsMasaJabatan));

        // grafik pengajuan cuti

        $groupCuti = [
            'Cuti Tahunan' =>  PengajuanCuti::select('jenis_cuti')
                ->where('jenis_cuti', '=', 'Cuti tahunan')
                ->count(),

            'Cuti Sakit' => PengajuanCuti::select('jenis_cuti')
                ->where('jenis_cuti', '=', 'Cuti sakit')
                ->count(),

            'Cuti Bersalin' => PengajuanCuti::select('jenis_cuti')
                ->where('jenis_cuti', '=', 'Cuti Bersalin')
                ->count(),

            'Cuti Besar' => PengajuanCuti::select('jenis_cuti')
                ->where('jenis_cuti', '=', 'Cuti besar')
                ->count(),
        ];

        $grafikCuti = new PengajuanCuti;
        $grafikCuti->labels = (array_keys($groupCuti));
        $grafikCuti->dataset = (array_values($groupCuti));
        $pengajuanCuti = PengajuanCuti::with('user')->get();

        //grafik cuti by users
        $userCuti = PengajuanCuti::with('user')->get();

        foreach ($userCuti as $key => $value) {
            $groupCutiUser[$value->user->name] = $value->where('user_id', '=', $value->user->id)
                ->where('status', '=', 'Disetujui')
                ->count();
        }

        // Generate random colours for the groups
        for ($i = 0; $i <= count($groupCutiUser ?? []); $i++) {
            $warnagrafikCutiUsers[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        $grafikCutiUsers = new PengajuanCuti;
        $grafikCutiUsers->labels = (array_keys($groupCutiUser ?? []));
        $grafikCutiUsers->dataset = (array_values($groupCutiUser ?? []));
        $grafikCutiUsers->warnagrafikCutiUsers = $warnagrafikCutiUsers;

        //grafik perjalanan dinas

        $perjalananDinas = Pengikut::where('perjalanan_dinas_id', '!=', null)->get();

        foreach ($perjalananDinas as $key => $value) {
            $groupPerjalananDinas[$value->user->name] = $value->where('user_id', '=', $value->user->id)
                ->count();
        }

        // Generate random colours for the groups
        for ($i = 0; $i <= count($groupPerjalananDinas ?? []); $i++) {
            $warnagrafikPerjalananDinas[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        $grafikPerjalananDinas = new Pengikut;
        $grafikPerjalananDinas->labels = (array_keys($groupPerjalananDinas ?? []));
        $grafikPerjalananDinas->dataset = (array_values($groupPerjalananDinas ?? []));
        $grafikPerjalananDinas->warnagrafikPerjalananDinas = $warnagrafikPerjalananDinas;

        return view('layouts.home', compact(
            'todayDate',
            'pengajuanCuti',
            'perjalananDinas',
            'pegawai',
            'grafikMasaKerja',
            'grafikMasaJabatan',
            'pengajuanCuti',
            'grafikCutiUsers',
            'grafikCuti',
            'grafikPerjalananDinas'
        ));
    }
}
