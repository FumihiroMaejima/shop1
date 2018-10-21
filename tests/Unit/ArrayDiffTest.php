<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArrayDiffTest extends TestCase
{
    public function testEquality()
    {
        $this->assertSame(
            [1, 2, 3, 4, 5, 6],
            [1, 2, 3, 44, 5, 6]
        );
    }

    // 要素の多い配列の比較に失敗した時のエラー出力
    public function testEquality2()
    {
        $this->assertSame(
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 3, 4, 5, 6],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 33, 4, 5, 6]
        );
    }

    // 緩い比較を使った場合のdiffの生成のエッジケース
    public function testEquality3()
    {
        $this->assertSame(
            [1, 2, 3, 4, 5, 6],
            ['1', 2, 3, 44, 5, 6]
        );
    }
}
