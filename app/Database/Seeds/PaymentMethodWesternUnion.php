<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodWesternUnion extends Seeder
{
    public function run()
    {
        $data = [
            [
                'payment_method_id' => 4,
                'name' => 'Western Union',
                'code' => 'western_union',
                'image' => 'western_union_1693227784_6fff290ee998d1951995.png',
                'status' => '1',
            ],
        ];
        // Using Query Builder
        $this->db->table('cc_payment_method')->insertBatch($data);
        $payment_method_id = $this->db->insertID();

        $dataSettings = [
            [
                'settings_id' => 4,
                'payment_method_id' => $payment_method_id,
                'label' => 'instruction',
                'title' => 'Western Union Instruction',
                'value' => 'A set of payment instructions will be sent to you shortly. Please check your spam or junk if you do not see it in your inbox. If no instruction is receive within 24 hours, please email us at amazinggadgets@gmail.com',
            ],
        ];
        $this->db->table('cc_payment_settings')->insertBatch($dataSettings);
    }
}
