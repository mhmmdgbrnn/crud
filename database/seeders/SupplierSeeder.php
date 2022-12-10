<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'kode' => 'S0001',
            'nama' => 'PT. Gajah Tunggal',
            'telepon' => '08892202420',
            'alamat' => 'Jln. Cihideung'
        ]);
    }
}
