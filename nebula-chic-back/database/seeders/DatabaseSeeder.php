<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      ProductTypeSeeder::class,
      ProductSeeder::class,
      ImageSeeder::class,
      SizeSeeder::class,
    ]);

    /**
     * Populate the product_size table with at least 3 sizes for each product with product_type_id = 1
     */
    for ($i = 1; $i <= Product::where('product_type_id', 1)->count(); $i++) {
      $product = Product::where('product_type_id', 1)->find($i);

      $randomSizes = range(1, 6);
      shuffle($randomSizes);
      $selectedSizes = array_slice($randomSizes, 0, 3);

      $product->sizes()->attach($selectedSizes);
    }
  }
}
