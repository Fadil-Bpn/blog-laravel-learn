<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Category::create([
        //     'name'=>'Desain UI/UX',
        //     'slug'=> 'desain-uiux',
        // ]);
        // Post::create([
        //     'title'=>'Tutorial Mendesain Website Menggunakan Figma',
        //     'author_id'=>1,
        //     'category_id'=>1,
        //     'slug'=>'tutorial-mendesain-web-menggunakan-figma',
        //     'body'=>'Dengan pembuatan prototipe di Figma, Anda dapat membuat beberapa alur untuk prototipe Anda dalam satu halaman untuk melihat pratinjau perjalanan dan pengalaman lengkap pengguna melalui desain Anda.Alur adalah jaringan bingkai dan koneksi dalam satu halaman. Prototipe dapat memetakan seluruh perjalanan pengguna melalui aplikasi atau situs web Anda, atau dapat berfokus pada segmen tertentu melalui alurnya sendiri. Misalnya: prototipe Anda mencakup semua kemungkinan interaksi di situs eCommerce. Dalam prototipe, Anda memiliki alur untuk membuat akun, menambahkan item ke keranjang, dan melakukan pembayaran.Figma membuat titik awal alur saat Anda menambahkan koneksi pertama antara dua frame. Ada beberapa cara lain untuk menambahkan titik awal alur ke prototipe Anda:'
        // ]);
        $this->call([CategorySeeder::class, UserSeeder::class]);
        Post::factory(100)->recycle([
            Category::all(),
            User::all()
         ])->create();

    }
}
