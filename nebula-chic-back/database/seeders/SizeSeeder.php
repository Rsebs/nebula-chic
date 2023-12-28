<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::insert([
            [
                'cod' => 'XS',
                'name' => 'Muy Pequeña',
            ],
            [
                'cod' => 'S',
                'name' => 'Pequeña',
            ],
            [
                'cod' => 'M',
                'name' => 'Mediana',
            ],
            [
                'cod' => 'L',
                'name' => 'Grande',
            ],
            [
                'cod' => 'XL',
                'name' => 'Extra Grande',
            ],
            [
                'cod' => 'XXL',
                'name' => 'Extra Extra Grande',
            ],
        ]);
    }
}
