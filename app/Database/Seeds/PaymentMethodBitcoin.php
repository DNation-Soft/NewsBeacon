<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodBitcoin extends Seeder
{
    public function run()
    {
        $data = [
            [
                'payment_method_id' => 6,
                'name' => 'Bitcoin',
                'code' => 'bitcoin',
                'image' => 'bitcoin_1693229111_ab1db8a222a0b4082eb1.png',
                'status' => '1',
            ],
        ];
        // Using Query Builder
        $this->db->table('cc_payment_method')->insertBatch($data);
        $payment_method_id = $this->db->insertID();

        $dataSettings = [
            [
                'settings_id' => 6,
                'payment_method_id' => $payment_method_id,
                'label' => 'instruction',
                'title' => 'Bitcoin Instruction',
                'value' => 'A set of payment instructions will be sent to you shortly. Please check your spam or junk if you do not see it in your inbox. If no instruction is receive within 24 hours, please email us at amazinggadgets@gmail.com',
            ],
        ];
        $this->db->table('cc_payment_settings')->insertBatch($dataSettings);
    }
}
