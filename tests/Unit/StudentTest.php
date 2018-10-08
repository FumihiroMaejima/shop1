<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // 期待値
        $expected = 5;

        // 実際の値
        $actual = 2 + 3;

        // チェック
        //$this->assertTrue(true);
        $this->assertEquals($expected, $actual);
    }
}
