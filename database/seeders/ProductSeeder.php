<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['product1', 100, 10],
            ['product2', 600, 10],
            ['product3', 500, 10],
            ['product4', 400, 10],
            ['product5', 300, 10],
            ['product6', 200, 10],
        ];

        foreach ($products as $product)
        {
            Product::create([
                'name' => $product[0],
                'price' => $product[1],
                'stock' => $product[2],
            ]);
        }
    }
}
