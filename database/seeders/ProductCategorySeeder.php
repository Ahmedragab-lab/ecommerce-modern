<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;


class ProductCategorySeeder extends Seeder
{


    public function run()
    {
        $clothes =
        ProductCategory::create(['name' => 'شفاه', 'cover' => 'شفاه.jpg', 'status' => true, 'parent_id' => null]);
        ProductCategory::create(['name' => 'Women\'s T-Shirts', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Men\'s T-Shirts', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Dresses', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Novelty socks', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Women\'s sunglasses', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Men\'s sunglasses', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);

        $shoes = ProductCategory::create(['name' => 'عطور', 'cover' => 'عطور.jpg', 'status' => true]);
        ProductCategory::create(['name' => 'Women\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create(['name' => 'Men\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create(['name' => 'Boy\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create(['name' => 'Girls\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);

        $watches = ProductCategory::create(['name' => 'حواجب', 'cover' => 'حواجب.jpg', 'status' => true]);
        ProductCategory::create(['name' => 'Women\'s Watches', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create(['name' => 'Men\'s Watches', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create(['name' => 'Boy\'s Watches', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create(['name' => 'Girls\'s Watches', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);

        $electronics =
        ProductCategory::create(['name' => 'ادوات-تجميل', 'cover' => 'ادوات-تجميل.jpg', 'status' => true]);
        ProductCategory::create(['name' => 'smart-tv', 'cover' => 'smart-tv.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'labtop', 'cover' => 'labtop.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'Headphone', 'cover' => 'Headphone.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'smart-phone', 'cover' => 'smart-phone.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'camira', 'cover' => 'camira.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'playstation-5', 'cover' => 'playstation-5.jpg', 'status' => true, 'parent_id' => $electronics->id]);
    }

}
