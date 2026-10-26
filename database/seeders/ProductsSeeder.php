<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records to prevent duplicates
        DB::table('products')->truncate();

        DB::table('products')->insert([
            [
                'id' => 2,
                'name' => 'Chicken 1KG',
                'price' => 30.00,
                'category' => 'Meat Products',
                'stock' => 40,
                'image' => 'products/Ek7nA0CWCxlFORFWiJm8uwZc8F8MOaJFNbUZUL1T.jpg',
                'created_at' => '2026-02-06 15:34:52',
                'updated_at' => '2026-02-06 15:34:52',
            ],
            [
                'id' => 3,
                'name' => 'Beef 1KG',
                'price' => 45.00,
                'category' => 'Meat Products',
                'stock' => 40,
                'image' => 'products/J2ZTg83BFHCyvRGnKMYa4eTtRUcjoAB5hn8I4eBP.jpg',
                'created_at' => '2026-02-06 15:35:27',
                'updated_at' => '2026-02-06 15:35:27',
            ],
            [
                'id' => 4,
                'name' => 'Turkey 1KG',
                'price' => 55.00,
                'category' => 'Meat Products',
                'stock' => 50,
                'image' => 'products/OwGaUbyNPiKhbYxgVdogi64TZia4Feyaim7ex6Md.jpg',
                'created_at' => '2026-02-06 15:36:10',
                'updated_at' => '2026-02-06 15:36:10',
            ],
            [
                'id' => 5,
                'name' => 'Pork 1KG',
                'price' => 40.00,
                'category' => 'Meat Products',
                'stock' => 40,
                'image' => 'products/rA7yKGhmUqFyH4Y1b9Ao5OywK7cqWeQeeehpz507.jpg',
                'created_at' => '2026-02-06 15:37:07',
                'updated_at' => '2026-02-06 15:37:07',
            ],
            [
                'id' => 6,
                'name' => 'Mutton 1KG',
                'price' => 45.00,
                'category' => 'Meat Products',
                'stock' => 40,
                'image' => 'products/Vno0rrmFkwvh4JmW60JNIZD2tKKW8Wf4uT1coSOe.jpg',
                'created_at' => '2026-02-06 15:37:46',
                'updated_at' => '2026-02-06 15:37:46',
            ],
            [
                'id' => 7,
                'name' => 'Brown Bread 400G',
                'price' => 45.00,
                'category' => 'Breakfast',
                'stock' => 40,
                'image' => 'products/z2vrEMFB6DkyDx6erHG8GLlR3mGzacHbYP6QdEFF.jpg',
                'created_at' => '2026-02-06 15:39:12',
                'updated_at' => '2026-02-06 15:39:12',
            ],
            [
                'id' => 8,
                'name' => 'White Bread 400G',
                'price' => 45.00,
                'category' => 'Breakfast',
                'stock' => 54,
                'image' => 'products/GvdN8GN3JiZLXo23q9iTZ0hfC8FWiQunw7CUn70I.jpg',
                'created_at' => '2026-02-06 15:39:42',
                'updated_at' => '2026-02-06 15:39:42',
            ],
            [
                'id' => 9,
                'name' => 'Croissants',
                'price' => 45.00,
                'category' => 'Breakfast',
                'stock' => 46,
                'image' => 'products/LhkfbQQRDPdphhBS8bbT4Mxg6Mx9sQvpUcCVBxKO.jpg',
                'created_at' => '2026-02-06 15:40:18',
                'updated_at' => '2026-02-06 15:40:18',
            ],
            [
                'id' => 10,
                'name' => 'Muffins 400G',
                'price' => 24.00,
                'category' => 'Breakfast',
                'stock' => 40,
                'image' => 'products/I3llyJZuE2gYQlzcdJzjTN04TI52aBHowgAZhwXd.jpg',
                'created_at' => '2026-02-06 15:40:48',
                'updated_at' => '2026-02-06 15:40:48',
            ],
            [
                'id' => 11,
                'name' => 'Corn Flakes 400G',
                'price' => 45.00,
                'category' => 'Breakfast',
                'stock' => 40,
                'image' => 'products/EBqnaRMEMcqaZNIeEpcf2sWFGwlj2PATucCmEBSp.jpg',
                'created_at' => '2026-02-06 15:41:28',
                'updated_at' => '2026-02-06 15:41:28',
            ],
            [
                'id' => 12,
                'name' => 'Kales 1KG',
                'price' => 40.00,
                'category' => 'Vegetables',
                'stock' => 45,
                'image' => 'products/VbRCj0CsdRJNatvA6RUhjRcJqYe0ODWsZqnNLSQy.jpg',
                'created_at' => '2026-02-06 15:42:12',
                'updated_at' => '2026-02-06 15:42:12',
            ],
            [
                'id' => 13,
                'name' => 'Brussel Sprouts 1KG',
                'price' => 40.00,
                'category' => 'Vegetables',
                'stock' => 40,
                'image' => 'products/n2Hq4xccwA8YMFg9sMbnKUNyKc1dsv3xbFND4cRu.jpg',
                'created_at' => '2026-02-06 15:43:27',
                'updated_at' => '2026-02-06 15:43:27',
            ],
            [
                'id' => 14,
                'name' => 'Brocolli 1KG',
                'price' => 25.00,
                'category' => 'Vegetables',
                'stock' => 40,
                'image' => 'products/RHJzP4PZKhCXM8VwlNwScBy4lmHlrmOxngBS5399.jpg',
                'created_at' => '2026-02-06 15:43:56',
                'updated_at' => '2026-02-06 15:43:56',
            ],
            [
                'id' => 15,
                'name' => 'Pumpkin 1KG',
                'price' => 40.00,
                'category' => 'Vegetables',
                'stock' => 40,
                'image' => 'products/VxWZ1Lr2r3RtfwBMmXN40YNdQ1XgUAZCJ79Fy7g6.jpg',
                'created_at' => '2026-02-06 15:44:55',
                'updated_at' => '2026-02-06 15:44:55',
            ],
            [
                'id' => 16,
                'name' => 'Spinach 1KG',
                'price' => 45.00,
                'category' => 'Vegetables',
                'stock' => 40,
                'image' => 'products/MHLRGr8E0pCeCgFAXAXHWI7HLj9gNM0nhmKUhbZV.jpg',
                'created_at' => '2026-02-06 15:46:43',
                'updated_at' => '2026-02-06 15:46:43',
            ],
        ]);
    }
}