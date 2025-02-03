<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodStripe extends Seeder
{
    public function run()
    {
        $data = [
            [
                'payment_method_id' => 9,
                'name' => 'Stripe',
                'code' => 'stripe',
                'image' => 'stripe_1711190105_76334e85265e1bfe92f5.png',
                'status' => '1',
            ],
        ];
        // Using Query Builder
        $this->db->table('cc_payment_method')->insertBatch($data);
        $payment_method_id = $this->db->insertID();

        $dataSettings = [
            [
                'settings_id' => 13,
                'payment_method_id' => $payment_method_id,
                'label' => 'key',
                'title' => 'Key',
                'value' => 'pk_test_51HiuQiDVsvPo6h6ZrkChvkyVywgbs83tPg809JsvQLqyJ3JAlXbXhTOlwZEmlzXud1paIE87z7o5erGMEUbDrevD00jOYwmg2Y',
            ],
            [
                'settings_id' => 14,
                'payment_method_id' => $payment_method_id,
                'label' => 'secret_key',
                'title' => 'Secret Key',
                'value' => 'sk_test_51HiuQiDVsvPo6h6ZmBoulU8B7qWOCl6qYC3feinEzPuj0lLICpwhE2vEHncoIA6fZaKSjXMDn09L8ueDBMzt3I6Z00SA7fC6xY',
            ],
        ];
        // Using Query Builder
        $this->db->table('cc_payment_settings')->insertBatch($dataSettings);
    }
}
