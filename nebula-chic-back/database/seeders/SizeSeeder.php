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
    $aSeederData = [
      [
        'id' => 1,
        'cod' => 'XS',
        'name' => 'Muy Pequeña'
      ],
      [
        'id' => 2,
        'cod' => 'S',
        'name' => 'Pequeña'
      ],
      [
        'id' => 3,
        'cod' => 'M',
        'name' => 'Mediana'
      ],
      [
        'id' => 4,
        'cod' => 'L',
        'name' => 'Grande'
      ],
      [
        'id' => 5,
        'cod' => 'XL',
        'name' => 'Extra Grande'
      ],
      [
        'id' => 6,
        'cod' => 'XXL',
        'name' => 'Extra Extra Grande'
      ],
    ];

    foreach ($aSeederData as $oData) {
      Size::updateOrCreate(['id' => $oData['id']], $oData);
    }
  }
}
