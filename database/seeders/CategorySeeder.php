<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Snack Manis',
                'slug' => 'sanack-manis',
                'description' => 'Berbagai jenis snack manis seperti kue, cokelat, dan camilan manis lainnya',
                'is_active' => true,
            ],
            [
                'name' => 'Snack Gurih & Pedas',
                'slug' => 'snack-gurih-pedas',
                'description' => 'Berbagai jenis snack gurih dan pedas seperti keripik, kacang, dan camilan asin lainnya',
                'is_active' => true,
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'description' => 'Berbagai jenis minuman seperti air mineral, teh, kopi, dan minuman beralkohol',
                'is_active' => true,
            ],
            [
                'name' => 'Snack Sehat',
                'slug' => 'snack-sehat',
                'description' => 'Berbagai jenis snack sehat seperti buah-buahan, biji-bijian, dan camilan sehat lainnya',
                'is_active' => true,
            ],
            [
                'name' => 'Snack Tradisional',
                'slug' => 'snack-tradisional',
                'description' => 'Berbagai jenis snack tradisional seperti keripik, kacang, dan camilan tradisional lainnya',
                'is_active' => true,
            ],
            [
                'name' => 'Snack Viral',
                'slug' => 'snack-viral',
                'description' => 'Berbagai jenis snack viral seperti keripik, kacang, dan camilan viral lainnya',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Categories seeded successfully!');
    }
}