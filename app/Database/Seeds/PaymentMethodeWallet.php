<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodeWallet extends Seeder
{
    public function run()
    {
        $data = [
            [
                'payment_method_id' => 8,
                'name' => 'eWallet',
                'code' => 'u_wallet',
                'status' => '1',
            ],
        ];

        // Using Query Builder
        $this->db->table('cc_payment_method')->insertBatch($data);
    }
}
