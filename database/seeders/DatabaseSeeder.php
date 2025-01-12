<?php

namespace Database\Seeders;

use App\Models\DataUser;
use App\Models\Mobil;
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
            'is_admin' => true,
        ]);

        User::factory()->create([
            'id' => 2,
            'name' => 'User',
            'username' => 'user',
            'password' => Hash::make('user123'),
            'is_admin' => false,
        ]);

        // Seeder to create a user
        DataUser::factory()->create([
            'nama' => 'John Doe',
            'alamat' => 'Jl. Raya No. 123',
            'no_telp' => '1234567890',
            'no_sim' => '1234567890',
            'user_id' => 2
        ]);

        // Seeder to create a mobil entry
        Mobil::factory()->create([
            'id' => 1,
            'merk' => 'Toyota Avanza',
            'model' => 'Racing',
            'no_plat' => 'B 1234 ABC',
            'tarif' => 500000,
        ]);
        Mobil::factory()->create([
            'id' => 2,
            'merk' => 'Honda Civic',
            'model' => 'Sedan',
            'no_plat' => 'C 5678 XYZ',
            'tarif' => 700000,
        ]);
        Mobil::factory()->create([
            'id' => 3,
            'merk' => 'Lamborghini Aventador',
            'model' => 'Sedan',
            'no_plat' => 'D 9012 ABC',
            'tarif' => 1000000,
        ]);
        Mobil::factory()->create([
            'id' => 4,
            'merk' => 'Maruti Suzuki Swift',
            'model' => 'Offroad',
            'no_plat' => 'E 3456 XYZ',
            'tarif' => 400000,
        ]);
    }
}
