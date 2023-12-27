<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('pasien')->insert([
            [
                'id' => '1',
                'nama' => 'John Doe',
                'alamat' => 'Kp. Kemuning RT 01 RW 04, Kemuning Legok, Kabupaten Tangerang, Banten',
                'no_ktp' => '1122334455',
                'no_hp' => '083891428869',
                'no_rm' => '202312-1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('poli')->insert([
            [
                'id' => '1',
                'nama_poli' => 'POLI001',
                'keterangan' => 'Poli Umum 001',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('dokter')->insert([
            [
                'id' => '1',
                'nama' => 'Dr. Jane Doe',
                'email' => 'dokter@gmail.com',
                'password' => Hash::make('password'),
                'alamat' => 'Kp. Kemuning RT 01 RW 04, Kemuning Legok, Kabupaten Tangerang, Banten',
                'no_hp' => '083891428869',
                'id_poli' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('jadwal_periksa')->insert([
            [
                'id' => '1',
                'id_dokter' => '1',
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('daftar_poli')->insert([
            [
                'id' => '1',
                'id_pasien' => '1',
                'id_jadwal' => '1',
                'keluhan' => 'Sakit Kepala',
                'no_antrian' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('periksa')->insert([
            [
                'id' => '1',
                'id_daftar_poli' => '1',
                'tgl_periksa' => '2021-06-01',
                'catatan' => 'Sakit Kepala',
                'biaya_periksa' => '160000',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('obat')->insert([
            [
                'id' => '1',
                'nama_obat' => 'Paracetamol',
                'kemasan' => '10 Tablet',
                'harga' => '10000',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'nama_obat' => 'Amoxilin',
                'kemasan' => '10 Tablet',
                'harga' => '20000',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('detail_periksa')->insert([
            [
                'id_periksa' => '1',
                'id_obat' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
