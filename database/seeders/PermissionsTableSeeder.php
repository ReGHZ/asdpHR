<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $Permissionitems = [
            // Users
            [
                'name'        => 'lihat daftar pegawai',
                'slug'        => 'daftar.users',
                'description' => 'lihat daftar pegawai',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'lihat detail pegawai',
                'slug'        => 'view.users',
                'description' => 'lihat detail pegawai',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'membuat pegawai',
                'slug'        => 'create.users',
                'description' => 'bisa membuat pegawai',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'edit pegawai',
                'slug'        => 'edit.users',
                'description' => 'bisa edit pegawai',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'delete pegawai',
                'slug'        => 'delete.users',
                'description' => 'bisa delete pegawai',
                'model'       => 'Permission',
            ],
            //divisi
            [
                'name'        => 'lihat daftar divisi',
                'slug'        => 'daftar.divisi',
                'description' => 'lihat daftar divisi',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'membuat divisi',
                'slug'        => 'create.divisi',
                'description' => 'bisa membuat divisi',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'edit divisi',
                'slug'        => 'edit.divisi',
                'description' => 'bisa edit divisi',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'delete divisi',
                'slug'        => 'delete.divisi',
                'description' => 'bisa delete divisi',
                'model'       => 'Permission',
            ],
            //jabatan
            [
                'name'        => 'lihat daftar jabatan',
                'slug'        => 'daftar.jabatan',
                'description' => 'lihat daftar jabatan',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'membuat jabatan',
                'slug'        => 'create.jabatan',
                'description' => 'bisa membuat jabatan',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'edit jabatan',
                'slug'        => 'edit.jabatan',
                'description' => 'bisa edit jabatan',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'delete jabatan',
                'slug'        => 'delete.jabatan',
                'description' => 'bisa delete jabatan',
                'model'       => 'Permission',
            ],
            // pengajuan cuti
            [
                'name'        => 'lihat daftar cuti',
                'slug'        => 'daftar.cuti',
                'description' => 'lihat daftar cuti',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'lihat detail cuti',
                'slug'        => 'view.cuti',
                'description' => 'lihat detail cuti',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'membuat cuti',
                'slug'        => 'create.cuti',
                'description' => 'bisa membuat cuti',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'edit cuti',
                'slug'        => 'edit.cuti',
                'description' => 'bisa edit cuti',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'delete cuti',
                'slug'        => 'delete.cuti',
                'description' => 'bisa delete cuti',
                'model'       => 'Permission',
            ],
            // persetujuan cuti
            [
                'name'        => 'lihat daftar persetujuan cuti',
                'slug'        => 'daftar.persetujuancuti',
                'description' => 'lihat daftar persetujuan cuti',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'lihat detail persetujuan cuti',
                'slug'        => 'view.persetujuancuti',
                'description' => 'lihat detail persetujuan cuti',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'membuat persetujuan cuti',
                'slug'        => 'create.persetujuancuti',
                'description' => 'bisa membuat persetujuan cuti',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'edit persetujuan cuti',
                'slug'        => 'edit.persetujuancuti',
                'description' => 'bisa edit persetujuan cuti',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'delete persetujuan cuti',
                'slug'        => 'delete.persetujuancuti',
                'description' => 'bisa delete persetujuan cuti',
                'model'       => 'Permission',
            ],
        ];

        /*
         * Add Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
    }
}
