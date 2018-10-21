<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Data2Test extends TestCase
{
    public function provider()
    {
        return [['provider1'], ['provider2']];
    }

    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }
    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
    * @depends testProducerFirst
    * @depends testProducerSecond
    * @dataProvider provider
    **/
    public function testConsumer()
    {
        $this->assertSame(
            ['provider1', 'first', 'second'],
            func_get_args()
        );
    }

    // 一つのテストで複数のデータプロバイダを使用
    /**
    * @dataProvider additionWithNonNegativeNumbersProvider
    * @dataProvider additionWithNegativeNumbersProvider
    **/
    public function testAdd($a, $b, $expected)
    {
        $this->assertSame($expected, $a + $b);
    }

    public function additionWithNonNegativeNumbersProvider()
    {
        return [
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 3]
        ];
    }

    public function additionWithNegativeNumbersProvider()
    {
        return [
            [-1, 1, 0],
            [-1, -1, -2],
            [1, -1, 0]
        ];
    }
}
