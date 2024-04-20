<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1, 
                'kategori_id' => 1, 
                'barang_kode' => 'BRG001', 
                'barang_nama' => 'Laptop', 
                'harga_beli' => 800, 
                'harga_jual' => 1200
            ],
            [
                'barang_id' => 2, 
                'kategori_id' => 2, 
                'barang_kode' => 'BRG002', 
                'barang_nama' => 'T-shirt',
                'harga_beli' => 20, 
                'harga_jual' => 30
            ],
            [
                'barang_id' => 3, 
                'kategori_id' => 3, 
                'barang_kode' => 'BRG003', 
                'barang_nama' => 'Meja', 
                'harga_beli' => 150, 
                'harga_jual' => 250
            ],
            [
                'barang_id' => 4, 
                'kategori_id' => 4, 
                'barang_kode' => 'BRG004', 
                'barang_nama' => 'Coklat', 
                'harga_beli' => 5, 
                'harga_jual' => 10
            ],
            [
                'barang_id' => 5, 
                'kategori_id' => 5, 
                'barang_kode' => 'BRG005', 
                'barang_nama' => 'Action Figure',
                'harga_beli' => 15,
                'harga_jual' => 25
            ],
            [
                'barang_id' => 6, 
                'kategori_id' => 1, 
                'barang_kode' => 'BRG006', 
                'barang_nama' => 'Smartphone', 
                'harga_beli' => 500, 
                'harga_jual' => 700
            ],
            [
                'barang_id' => 7, 
                'kategori_id' => 2, 
                'barang_kode' => 'BRG007', 
                'barang_nama' => 'Jeans',
                'harga_beli' => 40, 
                'harga_jual' => 60
            ],
            [
                'barang_id' => 8, 
                'kategori_id' => 3, 
                'barang_kode' => 'BRG008', 
                'barang_nama' => 'Rak Buku',
                'harga_beli' => 80,
                'harga_jual' => 120
            ],
            [
                'barang_id' => 9, 
                'kategori_id' => 4, 
                'barang_kode' => 'BRG009', 
                'barang_nama' => 'Susu', 
                'harga_beli' => 3, 
                'harga_jual' => 6
            ],
            [
                'barang_id' => 10, 
                'kategori_id' => 5, 
                'barang_kode' => 'BRG010', 
                'barang_nama' => 'Board Game', 
                'harga_beli' => 25, 
                'harga_jual' => 40
            ],
        ];
        

        DB::table('m_barang')->insert($data);
    }
}
