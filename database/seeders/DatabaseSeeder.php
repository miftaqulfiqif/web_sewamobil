<?php

namespace Database\Seeders;

use App\Models\DataUser;
use App\Models\Mobil;
use App\Models\Pinjaman;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seeder to create an admin user
        User::factory()->create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        User::factory()->create([
            'id' => 2,
            'name' => 'User',
            'username' => 'user',
            'email' => null,
            'password' => Hash::make('user123'),
        ]);

        // Seeder to create a user
        DataUser::create([
            'id' => 1,
            'nama' => 'User',
            'alamat' => 'Jl. Raya No. 123',
            'no_telp' => '1234567890',
            'no_sim' => '1234567890',
            'user_id' => 2,
        ]);

        // Seeder to create a mobil entry
        Mobil::create([
            'id' => 1,
            'merk' => 'Toyota Avanza',
            'model' => 'Racing',
            'no_plat' => 'B 1234 ABC',
            'tarif' => 500000,
            'status' => 1
        ]);
        Mobil::create([
            'id' => 2,
            'merk' => 'Honda Civic',
            'model' => 'Sedan',
            'no_plat' => 'C 5678 XYZ',
            'tarif' => 700000,
            'status' => 1
        ]);
        Mobil::create([
            'id' => 3,
            'merk' => 'Lamborghini Aventador',
            'model' => 'Sedan',
            'no_plat' => 'D 9012 ABC',
            'tarif' => 1000000,
            'status' => 1
        ]);
        Mobil::create([
            'id' => 4,
            'merk' => 'Maruti Suzuki Swift',
            'model' => 'Offroad',
            'no_plat' => 'E 3456 XYZ',
            'tarif' => 400000,
            'status' => 1
        ]);

        // Seeder to create a pinjaman entry
        Pinjaman::create([
            'id' => 1,
            'mobil_id' => 1,
            'data_user_id' => 1,
            'tanggal_mulai' => '2023-05-01',
            'tanggal_selesai' => '2023-05-10',
        ]);
        Pinjaman::create([
            'id' => 2,
            'mobil_id' => 2,
            'data_user_id' => 1,
            'tanggal_mulai' => '2025-05-05',
            'tanggal_selesai' => '2025-05-10',
        ]);
    }
}
