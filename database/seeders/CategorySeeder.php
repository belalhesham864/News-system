<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = fake()->date('Y-m-d h:m:s');
        $data = ['technology category', 'sports category', 'fashion category'];
        foreach ($data as $d) {
            Category::create([
                'name' => $d,
                'slug' => Str::slug($d),
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date,
                'SmallDesc'=>'Small description for SEO optimization'
            ]);
        }
    }
}
