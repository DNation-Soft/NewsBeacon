<?php

namespace Test\App\Libraries;

use CodeIgniter\Test\CIUnitTestCase;
use App\Libraries\Filter;
use CodeIgniter\Database\MigrationRunner;
use CodeIgniter\Test\DatabaseTestTrait;


class DatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrations;
    protected $seeder;
    protected $db;

    protected function setUp(): void
    {
        parent::setUp();

        // Load the test database
        $this->db = \Config\Database::connect('tests');

        // Set the database connection to the MigrationRunner
        $config = new \Config\Migrations();
        $config->enabled = true;
        $config->type = 'tests';
        $this->migrations = new MigrationRunner($config, $this->db);

        // Run migrations
        $this->migrations->latest();

        // Seed the database
        $this->seeder = \Config\Database::seeder();
        $this->seeder->call('AllDemo');
    }

    protected function tearDown(): void
    {
        // Rollback migrations or reset the database if needed
        $this->migrations->regress(0);
        parent::tearDown();
    }

    public function testFilter6()
    {

        $table = $this->db->table('cc_brand')
            ->where('createdBy', '1')
            ->where('updatedBy', null)
            ->where('name', 'Chanel')
            ->get()->getRow();
        $sum = $table->createdBy + 1;
        $this->assertSame(2, $sum);
    }


}