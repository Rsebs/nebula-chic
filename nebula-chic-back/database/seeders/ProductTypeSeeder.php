<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $aSeederData = [
      [
        'id' => 1,
        'name' => 'Prenda'
      ],
      [
        'id' => 2,
        'name' => 'Accesorio'
      ],
    ];

    foreach ($aSeederData as $oData) {
      ProductType::updateOrCreate(['id' => $oData['id']], $oData);
    }
  }
}
