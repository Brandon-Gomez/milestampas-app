<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // php artisan make:seeder ProductsTableSeeder
        // php artisan db:seed --class=ProductsTableSeeder

        DB::table('products')->insert([
            'name' => 'Android smartphone with a 6.5',
            'short_desc' => 'Android smartphone with a 6.5-inch display, octa-core processor, 4GB of RAM, 64GB storage (expandable), a triple rear camera setup (13MP main, 2MP depth, 2MP macro), an approximate 8MP front camera.',
            'image' => 'http://example.com/storage/app/public/products/phone.jpeg',
            'price' => 698.88,
            'category_id' => 1,
            'unlimited' => 1,

        ]);

        DB::table('products')->insert([
            'name' => 'Digital Camera EOS',
            'short_desc' => 'Canon cameras come in various models with diverse features, but generally, they offer high-quality imaging, a range of resolutions, interchangeable lenses, advanced autofocus systems.',
            'image' => 'http://example.com/storage/app/public/products/canon.jpg',
            'price' => 983.00,
            'category_id' => 1,
            'unlimited' => 1,

        ]);

        DB::table('products')->insert([
            'name' => 'LOIS CARON Watch',
            'short_desc' => 'The Lois Caron watch typically features a stainless steel case, quartz movement, analog display, synthetic leather or metal strap, and water resistance at varying depths.',
            'image' => 'http://example.com/storage/app/public/products/watch.jpg',
            'price' => 675.00,
            'category_id' => 1,
            'unlimited' => 1,

        ]);

        DB::table('products')->insert([
            'name' => 'Elegante unisex adult square',
            'short_desc' => 'Sunglasses come in a wide variety of styles, but they generally feature UV-protective lenses housed in plastic or metal frames.',
            'image' => 'http://example.com/storage/app/public/products/sunclass.jpg',
            'price' => 159.99,
            'category_id' => 1,
            'unlimited' => 1,

        ]);

        DB::table('products')->insert([
            'name' => 'Large Capacity Folding Bag',
            'short_desc' => 'A typical travel bag is designed with durable materials, multiple compartments, sturdy handles, and often includes wheels for easy maneuverability.',
            'image' => 'http://example.com/storage/app/public/products/bag.jpg',
            'price' => 68.00,
            'category_id' => 1,
            'unlimited' => 1,

        ]);

        DB::table('products')->insert([
            'name' => 'Lenovo Smartchoice Ideapad 3',
            'short_desc' => 'Lenovo laptops typically offer various configurations with features such as Intel or AMD processors.',
            'image' => 'http://example.com/storage/app/public/products/laptop.jpg',
            'price' => 129.99,
            'category_id' => 1,
            'unlimited' => 1,

        ]);
    }
}
