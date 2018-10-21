<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OutputTest extends TestCase
{
    public function testExpectFooActual1()
    {
        $this->expectOutputString('foo');
        print 'foo';
    }

    public function testExpectBarActualBaz()
    {
        // 出力値と期待値と異なる為failerとなる
        $this->expectOutputString('bar');
        print 'baz';

    }
}
