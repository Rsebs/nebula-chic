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
        Product::insert([
            [
                'name' => 'Camisetas con diseños Coleccion #1',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 1,
            ],
            [
                'name' => 'Camisetas con diseños Coleccion #2',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 1,
            ],
            [
                'name' => 'Conjuntos Colección #1',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 1,
            ],
            [
                'name' => 'Conjuntos Colección #2',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 1,
            ],
            [
                'name' => 'Pantalones Jogger',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 1,
            ],
            [
                'name' => 'Camisetas Oversize',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 1,
            ],
            [
                'name' => 'Camisetas con diseños Japoneses',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 1,
            ],
            [
                'name' => 'Kimonos Japoneses',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 1,
            ],
            [
                'name' => 'Cadenas de Rayo',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
            [
                'name' => 'Cadenas de gatos',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
            [
                'name' => 'Anillos para parejas',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
            [
                'name' => 'Aretes',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
            [
                'name' => 'Anillos',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
            [
                'name' => 'Anillos Emociones',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
            [
                'name' => 'Anillos Negro Plata',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
            [
                'name' => 'Pulseras',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
            [
                'name' => 'Pulseras para mujer',
                'description' => fake()->text(500),
                'price' => fake()->randomFloat(2, 10000, 50000),
                'product_type_id' => 2,
            ],
        ]);
    }
}
