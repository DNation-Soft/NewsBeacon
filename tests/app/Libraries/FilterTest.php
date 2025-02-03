<?php

namespace Test\App\Libraries;

use CodeIgniter\Test\CIUnitTestCase;

class FilterTest extends CIUnitTestCase
{
    public function testFilter()
    {
        $this->assertSame(0, 0);
    }

    public function testFilter2()
    {
        $this->assertSame(2, 2);
    }

    public function testFilter3()
    {
        $this->assertSame(3, 3);
    }

    public function testFilter4()
    {
        $this->assertSame(3, 3);
    }

    public function testFilter5()
    {
        $this->assertSame(5, 5);
    }
}