<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodPaypal extends Seeder
{
    public function run()
    {
        $data = [
            [
                'payment_method_id' => 3,
                'name' => 'Paypal',
                'code' => 'paypal',
                'image' => 'paypal_1692681576_8816a976c4c15e75aeb4.png',
                'status' => '1',
            ],
        ];
        // Using Query Builder
        $this->db->table('cc_payment_method')->insertBatch($data);
        $payment_method_id = $this->db->insertID();

        $dataSettings = [
            [
                'settings_id' => 7,
                'payment_method_id' => $payment_method_id,
                'label' => 'api_url',
                'title' => 'API URL',
                'value' => 'sandbox',
            ],
            [
                'settings_id' => 8,
                'payment_method_id' => $payment_method_id,
                'label' => 'api_username',
                'title' => 'Api Username',
                'value' => 'sb-u1koz27136347_api1.business.example.com',
            ],
            [
                'settings_id' => 9,
                'payment_method_id' => $payment_method_id,
                'label' => 'api_password',
                'title' => 'Api Password',
                'value' => 'Q6GHERFNRMSURNYD',
            ],
            [
                'settings_id' => 10,
                'payment_method_id' => $payment_method_id,
                'label' => 'api_signature',
                'title' => 'Api Signature',
                'value' => 'AwIggmgx-fAD0IWRrXWdFxsw.d--AlUB67UCRrfEheVSFrGOH9DRld-V',
            ],
        ];
        $this->db->table('cc_payment_settings')->insertBatch($dataSettings);
    }
}
