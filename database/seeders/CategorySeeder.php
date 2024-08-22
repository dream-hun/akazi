<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Jobs',
                'slug' => 'jobs',
                'status' => true,
            ],
            [
                'name' => 'Tenders',
                'slug' => 'tenders',
                'status' => true,
            ],
            [
                'name' => 'Consultancy',
                'slug' => 'consultancy',
                'status' => true,
            ],
            [
                'name' => 'Internships',
                'slug' => 'internships',
                'status' => true,
            ],
            [
                'name' => 'Public',
                'slug' => 'public',
                'status' => true,
            ],
            [
                'name' => 'Auction',
                'slug' => 'auction',
                'status' => true,
            ],
            [
                'name' => 'Others',
                'slug' => 'others',
                'status' => true,
            ],

        ];

        \App\Models\Category::insert($categories);
    }
}
