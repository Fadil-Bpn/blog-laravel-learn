<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role; // <-- Tambahkan ini

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role admin jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Buat user utama dan assign role admin
        $admin = User::create([
            'name' => 'Roja Fadilah',
            'username' => 'rojafadilah',
            'email' => 'roja@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token'=>Str::random(10),
        ]);

        $admin->assignRole($adminRole); // <-- Assign role ke user

        // Buat 5 user biasa
        User::factory(5)->create();
    }
}
