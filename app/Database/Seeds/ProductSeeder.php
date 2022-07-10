<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'product_name' => 'Product 1',
                'product_price' => '2500'
            ],
            [
                'product_name' => 'Product 2',
                'product_price' => '5000'
            ],
            [
                'product_name' => 'Product 3',
                'product_price' => '7000'
            ],
            [
                'product_name' => 'Product 4',
                'product_price' => '12000'
            ],
            [
                'product_name' => 'Product 5',
                'product_price' => '8000'
            ],
        ];

        $this->db->table('products')->insertBatch($data);
    }
}
