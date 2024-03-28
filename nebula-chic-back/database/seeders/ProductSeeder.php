<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $seederData = [
      [
        'id' => 1,
        'name' => 'Camisetas con diseños Coleccion #1',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 1,
      ],
      [
        'id' => 2,
        'name' => 'Camisetas con diseños Coleccion #2',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 1,
      ],
      [
        'id' => 3,
        'name' => 'Conjuntos Colección #1',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 1,
      ],
      [
        'id' => 4,
        'name' => 'Conjuntos Colección #2',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 1,
      ],
      [
        'id' => 5,
        'name' => 'Pantalones Jogger',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 1,
      ],
      [
        'id' => 6,
        'name' => 'Camisetas Oversize',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 1,
      ],
      [
        'id' => 7,
        'name' => 'Camisetas con diseños Japoneses',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 1,
      ],
      [
        'id' => 8,
        'name' => 'Kimonos Japoneses',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 1,
      ],
      [
        'id' => 9,
        'name' => 'Cadenas de Rayo',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
      [
        'id' => 10,
        'name' => 'Cadenas de gatos',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
      [
        'id' => 11,
        'name' => 'Anillos para parejas',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
      [
        'id' => 12,
        'name' => 'Aretes',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
      [
        'id' => 13,
        'name' => 'Anillos',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
      [
        'id' => 14,
        'name' => 'Anillos Emociones',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
      [
        'id' => 15,
        'name' => 'Anillos Negro Plata',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
      [
        'id' => 16,
        'name' => 'Pulseras',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
      [
        'id' => 17,
        'name' => 'Pulseras para mujer',
        'description' => fake()->text(500),
        'price' => fake()->randomFloat(2, 10000, 50000),
        'product_type_id' => 2,
      ],
    ];

    foreach ($seederData as $data) {
      Product::updateOrCreate(['id' => $data['id']], $data);
    }
  }
}
