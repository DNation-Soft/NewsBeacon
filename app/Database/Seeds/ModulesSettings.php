<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModulesSettings extends Seeder
{
    public function run()
    {
        $data = [
            [
                'module_settings_id' => 1,
                'module_id' => '5',
                'label' => 'whatsapp_number',
                'title' => 'Whatsapp number',
                'value' => '00000000000',
            ],

        ];

        // Using Query Builder
        $this->db->table('cc_module_settings')->insertBatch($data);
    }
}
