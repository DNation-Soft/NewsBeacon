<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AllDemo extends Seeder
{
    public function run()
    {
        $this->call('Country');
        $this->call('Zone');
        $this->call('Users');
        $this->call('Pages');
        $this->call('Settings');
        $this->call('Role');
        $this->call('PaymentMethod');
        $this->call('Modules');
        $this->call('ModulesSettings');
    }
}
