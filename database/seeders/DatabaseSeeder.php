<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Admin User
        User::create([
            'name' => 'Admin BKPSDM',
            'email' => 'admin@esatya.com',
            'password' => Hash::make('admin123'),
        ]);

        // Seed Departments (OPD)
        $departments = [
            'Dinas Pendidikan Kabupaten Simalungun',
            'Dinas Kesehatan Kabupaten Simalungun',
            'Dinas Pekerjaan Umum dan Penataan Ruang',
            'Badan Kepegawaian dan Pengembangan SDM',
            'Dinas Kependudukan dan Pencatatan Sipil',
            'Dinas Komunikasi dan Informatika',
            'Sekretariat Daerah Kabupaten Simalungun',
            'Dinas Pertanian Kabupaten Simalungun',
            'Dinas Keuangan Kabupaten Simalungun',
            'Dinas Sosial Kabupaten Simalungun',
        ];

        foreach ($departments as $name) {
            Department::create(['name' => $name]);
        }
    }
}
