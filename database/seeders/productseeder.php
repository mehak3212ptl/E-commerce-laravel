<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          
        $imageDir = public_path('images/');
    
        $images = glob($imageDir . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
    
        
        if (!empty($images)) {
            $randomImagePath = $images[array_rand($images)];
            $imageFilename = basename($randomImagePath);
    
            DB::table('products')->insert([
                'name' => Str::random(6),
                'description' =>Str::random(6),
                'category_id'=>1,
                'image' => 'images/' . $imageFilename 
            ]);
        }

    }
}
