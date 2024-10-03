<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OngkirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarifPerKm = 6000; // Tarif per kilometer

        // Estimasi jarak antar kabupaten dalam kilometer
        $jarak = [
            'Probolinggo' => [
                'Bangkalan' => 142,
                'Banyuwangi' => 196,
                'Blitar' => 196,
                'Bondowoso' => 110,
                'Gresik' => 121,
                'Jember' => 98,
                'Kediri' => 204,
                'Lamongan' => 158,
                'Madiun' => 262,
                'Magetan' => 262,
                'Malang' => 112,
                'Ngawi' => 262,
                'Pamekasan' => 222,
                'Ponorogo' => 274,
                'Sidoarjo' => 85,
                'Situbondo' => 100,
                'Sumenep' => 276,
                'Trenggalek' => 257,
                'Tuban' => 200,
                'Probolinggo' => 42, // Jarak ke dirinya sendiri
                'Mojokerto' => 133,
                'Jombang' => 169,
                'Surabaya' => 107,
                'Nganjuk' => 180,
                'Pacitan' => 353,
                'Sampang' => 190,
                'Pasuruan' => 46,
                'Tuban' => 205,
                'Lumajang' => 46,
                'Bojonegoro'=> 216,
            ]
        ];


        // Insert data ke dalam tabel ongkirs
        foreach ($jarak['Probolinggo'] as $kabupaten => $km) {
            // Hitung harga ongkir dasar
            $hargaOngkir = $km * $tarifPerKm;

            // Tentukan provinsi (ubah sesuai data yang Anda miliki)
            $provinsi = 'Jawa Timur'; // Ubah sesuai kebutuhan, misalnya ambil dari input atau data lainnya

            // Tambahkan biaya tambahan jika ada
            // if (array_key_exists($provinsi, $biayaTambahan)) {
            //     $hargaOngkir += $biayaTambahan[$provinsi];
            // }

            // Insert ke database
            DB::table('ongkirs')->insert([
                'kabupaten' => $kabupaten,
                'provinsi' => $provinsi,
                'harga_ongkir' => $hargaOngkir,
                'created_at' => now(), 
                'updated_at' => now()
            ]);
        }
          // Biaya tambahan berdasarkan provinsi
        // $biayaTambahan = [
        //     'Jawa Tengah' => 1000000,
        //     'Bali' => 500000,
        //     'Yogyakarta' => 1000000,
        //     'Jakarta' => 1500000,
        //     'Jawa Barat' => 1500000,
        // ];
    }
}

