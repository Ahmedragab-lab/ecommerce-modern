<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i <= 75; $i++){
            $images[] = ['file_name' => $i.'.jpg', 'file_type' => 'image/jpg', 'file_size' => rand(100, 900), 'file_status' => true, 'file_sort' => 0];
        }
        Product::all()->each(function ($product) use ($images) {
            $product->media()->createMany(Arr::random($images, rand(3, 5)));
        });
    }
}
