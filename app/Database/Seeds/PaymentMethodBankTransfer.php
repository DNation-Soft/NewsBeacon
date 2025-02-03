<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodBankTransfer extends Seeder
{
    public function run()
    {
        $data = [
            [
                'payment_method_id' => 2,
                'name' => 'Bank Transfer',
                'code' => 'bank_transfer',
                'image' => 'bank_1692269261_e30f1169975c89545ff2.png',
                'status' => '1',
            ],
        ];
        // Using Query Builder
        $this->db->table('cc_payment_method')->insertBatch($data);
        $payment_method_id = $this->db->insertID();

        $dataSettings = [
            [
                'settings_id' => 2,
                'payment_method_id' => $payment_method_id,
                'label' => 'instruction',
                'title' => 'Bank Transfer Instruction',
                'value' => 'A set of payment instructions will be sent to you shortly. Please check your spam or junk if you do not see it in your inbox. If no instruction is receive within 24 hours, please email us at amazingadgets@gmail.com',
            ],
        ];
        $this->db->table('cc_payment_settings')->insertBatch($dataSettings);
    }
}
