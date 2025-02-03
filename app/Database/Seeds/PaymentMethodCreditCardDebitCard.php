<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodCreditCardDebitCard extends Seeder
{
    public function run()
    {
        $data = [
            [
                'payment_method_id' => 7,
                'name' => 'Credit Card / Debit Card',
                'code' => 'credit_card',
                'status' => '1',
            ],
        ];
        // Using Query Builder
        $this->db->table('cc_payment_method')->insertBatch($data);
    }
}
