<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Category::factory(3)->create();
        Category::create([
            'name'=>'Web Design',
            'slug'=>'web-design',
            'color'=>'purple'
        ]);
        Category::create([
            'name'=>'UI UX',
            'slug'=>'ui-ux',
            'color'=>'blue'
        ]);
        Category::create([
            'name'=>'Cyber Security',
            'slug'=>'cyber-security',
            'color'=>'red'
        ]);
        Category::create([
            'name'=>'Backend Programming',
            'slug'=>'backend-programming',
            'color'=>'green'
        ]);

    }
}
