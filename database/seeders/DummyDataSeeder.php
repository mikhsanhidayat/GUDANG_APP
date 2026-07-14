<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Bahan;
use App\Models\ProductLog;
use App\Models\BahanLog;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // 1. Seed Products
        $products = [];
        $warnaProduk = ['Hitam', 'Biru Navy', 'Merah Maroon', 'Hijau Army', 'Abu-abu'];
        $logoProduk = ['IBI', 'IDI'];
        
        for ($i = 1; $i <= 15; $i++) {
            $nama = 'Jas Hujan ' . $faker->word;
            $kode = 'PRD-' . strtoupper(substr($nama, 0, 3)) . '-' . rand(100, 999) . $i;
            
            $product = Product::create([
                'kode_produk' => $kode,
                'nama_produk' => ucwords($nama),
                'warna' => $faker->randomElement($warnaProduk),
                'logo' => $faker->randomElement($logoProduk),
                'stok_tersedia' => rand(5, 100)
            ]);
            $products[] = $product;
        }

        // 2. Seed Bahan
        $bahans = [];
        $warnaBahan = ['Bening', 'Hitam', 'Putih', 'Kuning', 'Silver'];
        $namaBahanList = ['Kain Parasut', 'Plastik Mika', 'Resleting', 'Kancing Snap', 'Benang Jahit'];
        
        for ($i = 1; $i <= 15; $i++) {
            $nama = $faker->randomElement($namaBahanList) . ' ' . $faker->word;
            $kode = 'BHN-' . strtoupper(substr($nama, 0, 3)) . '-' . rand(100, 999) . $i;
            
            $bahan = Bahan::create([
                'kode_bahan' => $kode,
                'nama_bahan' => ucwords($nama),
                'warna' => $faker->randomElement($warnaBahan),
                'stok_tersedia' => rand(10, 500)
            ]);
            $bahans[] = $bahan;
        }

        // 3. Seed Product Logs (Masuk, Keluar, Retur)
        foreach ($products as $product) {
            // Masuk
            ProductLog::create([
                'kode_produk' => $product->kode_produk,
                'nama_produk' => $product->nama_produk,
                'jumlah' => rand(10, 50),
                'tipe_transaksi' => 'masuk',
                'petugas' => $faker->name,
                'created_at' => Carbon::now()->subDays(rand(1, 30))
            ]);

            // Keluar
            ProductLog::create([
                'kode_produk' => $product->kode_produk,
                'nama_produk' => $product->nama_produk,
                'jumlah' => rand(1, 10),
                'tipe_transaksi' => 'keluar',
                'penerima' => $faker->company,
                'keterangan' => 'Pesanan dikirim via kurir',
                'created_at' => Carbon::now()->subDays(rand(1, 30))
            ]);

            // Retur (probabilitas 30%)
            if (rand(1, 100) <= 30) {
                ProductLog::create([
                    'kode_produk' => $product->kode_produk,
                    'nama_produk' => $product->nama_produk,
                    'jumlah' => rand(1, 5),
                    'tipe_transaksi' => 'retur',
                    'kondisi' => $faker->randomElement(['bagus', 'rusak']),
                    'keterangan' => 'Retur dari pelanggan',
                    'created_at' => Carbon::now()->subDays(rand(1, 30))
                ]);
            }
        }

        // 4. Seed Bahan Logs (Masuk, Keluar, Retur)
        foreach ($bahans as $bahan) {
            // Masuk
            BahanLog::create([
                'kode_bahan' => $bahan->kode_bahan,
                'nama_bahan' => $bahan->nama_bahan,
                'jumlah' => rand(50, 200),
                'tipe_transaksi' => 'masuk',
                'supplier' => 'PT ' . $faker->company,
                'sisa_stok' => $bahan->stok_tersedia + rand(50, 200),
                'created_at' => Carbon::now()->subDays(rand(1, 30))
            ]);

            // Keluar
            BahanLog::create([
                'kode_bahan' => $bahan->kode_bahan,
                'nama_bahan' => $bahan->nama_bahan,
                'jumlah' => rand(10, 50),
                'tipe_transaksi' => 'keluar',
                'nama_pengambil' => $faker->name,
                'tujuan' => 'Produksi Batch #' . rand(100, 999),
                'created_at' => Carbon::now()->subDays(rand(1, 30))
            ]);

            // Retur (probabilitas 30%)
            if (rand(1, 100) <= 30) {
                BahanLog::create([
                    'kode_bahan' => $bahan->kode_bahan,
                    'nama_bahan' => $bahan->nama_bahan,
                    'jumlah' => rand(5, 20),
                    'tipe_transaksi' => 'retur',
                    'keterangan' => 'Sisa potongan/reject produksi',
                    'status' => $faker->randomElement(['selesai', 'pending']),
                    'created_at' => Carbon::now()->subDays(rand(1, 30))
                ]);
            }
        }
    }
}
