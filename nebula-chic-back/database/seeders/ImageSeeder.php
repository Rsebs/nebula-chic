<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::insert([
            [
                'path' => '/storage/images/products/PRENDA-Col1Camisa01.jpeg',
                'product_id' => 1,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col1Camisa02.jpeg',
                'product_id' => 1,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col2Camisa01.jpeg',
                'product_id' => 2,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col2Camisa02.jpeg',
                'product_id' => 2,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col1Conjunto01.jpeg',
                'product_id' => 3,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col1Conjunto02.jpeg',
                'product_id' => 3,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col1Conjunto03.jpeg',
                'product_id' => 3,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col2Conjunto01.jpeg',
                'product_id' => 4,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col2Conjunto02.jpeg',
                'product_id' => 4,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Col2Conjunto03.jpeg',
                'product_id' => 4,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Pantalon01.jpeg',
                'product_id' => 5,
            ],
            [
                'path' => '/storage/images/products/PRENDA-Pantalon02.jpeg',
                'product_id' => 5,
            ],
            [
                'path' => '/storage/images/products/PRENDA-CamisaOverSize01.jpeg',
                'product_id' => 6,
            ],
            [
                'path' => '/storage/images/products/PRENDA-CamisaOverSize02.jpeg',
                'product_id' => 6,
            ],
            [
                'path' => '/storage/images/products/PRENDA-CamisaJaponesa01.jpeg',
                'product_id' => 7,
            ],
            [
                'path' => '/storage/images/products/PRENDA-CamisaJaponesa02.jpeg',
                'product_id' => 7,
            ],
            [
                'path' => '/storage/images/products/PRENDA-KimonoNegro01.jpeg',
                'product_id' => 8,
            ],
            [
                'path' => '/storage/images/products/PRENDA-KimonoNegro02.jpeg',
                'product_id' => 8,
            ],
            [
                'path' => '/storage/images/products/ACC-CadenaRayo01.jpeg',
                'product_id' => 9,
            ],
            [
                'path' => '/storage/images/products/ACC-CadenaRayo02.jpeg',
                'product_id' => 9,
            ],
            [
                'path' => '/storage/images/products/ACC-CadenaGato01.jpeg',
                'product_id' => 10,
            ],
            [
                'path' => '/storage/images/products/ACC-CadenaGato02.jpeg',
                'product_id' => 10,
            ],
            [
                'path' => '/storage/images/products/ACC-CadenaGato03.jpeg',
                'product_id' => 10,
            ],
            [
                'path' => '/storage/images/products/ACC-AnilloParejas01.jpeg',
                'product_id' => 11,
            ],
            [
                'path' => '/storage/images/products/ACC-Arete01.jpeg',
                'product_id' => 12,
            ],
            [
                'path' => '/storage/images/products/ACC-Arete02.jpeg',
                'product_id' => 12,
            ],
            [
                'path' => '/storage/images/products/ACC-Anillos01.jpeg',
                'product_id' => 13,
            ],
            [
                'path' => '/storage/images/products/ACC-Anillos02.jpeg',
                'product_id' => 13,
            ],
            [
                'path' => '/storage/images/products/ACC-AnilloEmociones01.jpeg',
                'product_id' => 14,
            ],
            [
                'path' => '/storage/images/products/ACC-AnilloEmociones02.jpeg',
                'product_id' => 14,
            ],
            [
                'path' => '/storage/images/products/ACC-AnilloNegroPlata01.jpeg',
                'product_id' => 15,
            ],
            [
                'path' => '/storage/images/products/ACC-AnilloNegroPlata02.jpeg',
                'product_id' => 15,
            ],
            [
                'path' => '/storage/images/products/ACC-Pulsera01.jpeg',
                'product_id' => 16,
            ],
            [
                'path' => '/storage/images/products/ACC-Pulsera02.jpeg',
                'product_id' => 16,
            ],
            [
                'path' => '/storage/images/products/ACC-Pulsera03.jpeg',
                'product_id' => 16,
            ],
            [
                'path' => '/storage/images/products/ACC-Pulsera04.jpeg',
                'product_id' => 16,
            ],
            [
                'path' => '/storage/images/products/ACC-PulseraMujer01.jpeg',
                'product_id' => 17,
            ],
            [
                'path' => '/storage/images/products/ACC-PulseraMujer02.jpeg',
                'product_id' => 17,
            ],
            [
                'path' => '/storage/images/products/ACC-PulseraMujer03.jpeg',
                'product_id' => 17,
            ],
        ]);
    }
}
