<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Category::truncate();

        Schema::enableForeignKeyConstraints();


        // Daftar kategori tetap yang akan dimasukkan ke database.
        $categories = [
            ['name' => 'Meeting'],
            ['name' => 'Task'],
            ['name' => 'Social'],
            ['name' => 'Travelling'],
        ];

        // Melakukan loop dan membuat entri baru untuk setiap kategori
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
