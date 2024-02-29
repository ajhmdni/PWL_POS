<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'John Doe',
                'penjualan_kode' => 'PJN001',
                'penjualan_tanggal' => '2024-02-01',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 2,
                'pembeli' => 'Jane Doe',
                'penjualan_kode' => 'PJN002',
                'penjualan_tanggal' => '2024-02-02',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Bob Smith',
                'penjualan_kode' => 'PJN003',
                'penjualan_tanggal' => '2024-02-03',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 1,
                'pembeli' => 'Alice Johnson',
                'penjualan_kode' => 'PJN004',
                'penjualan_tanggal' => '2024-02-04',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Charlie Brown',
                'penjualan_kode' => 'PJN005',
                'penjualan_tanggal' => '2024-02-05',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Eva Green',
                'penjualan_kode' => 'PJN006',
                'penjualan_tanggal' => '2024-02-06',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Frank White',
                'penjualan_kode' => 'PJN007',
                'penjualan_tanggal' => '2024-02-07',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 2,
                'pembeli' => 'Grace Turner',
                'penjualan_kode' => 'PJN008',
                'penjualan_tanggal' => '2024-02-08',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Harry Black',
                'penjualan_kode' => 'PJN009',
                'penjualan_tanggal' => '2024-02-09',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 1,
                'pembeli' => 'Ivy Davis',
                'penjualan_kode' => 'PJN010',
                'penjualan_tanggal' => '2024-02-10',
            ],
        ];
        
        DB::table('t_penjualan')->insert($data);
    }
}
