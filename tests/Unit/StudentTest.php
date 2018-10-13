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
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'testData1');
        $this->assertSame('testData1', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('testData1', array_pop($stack));
        $this->assertSame(0, count($stack));
    }

    // アノテーションを使った依存性の表現
    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }

    // 引数としてtestEmptyの戻り値を使う為には下記のアノテーションが必要
    /**
    * @depends testEmpty
    **/
    public function testPush(array $stack)
    {
        array_push($stack, 'testData2');
        $this->assertSame('testData2', $stack[count($stack)-1]);

        return $stack;
    }

    /**
    * @depends testPush
    **/
    public function testPop(array $stack)
    {
        $this->assertSame('testData2', array_pop($stack));
        $this->assertEmpty($stack);
    }


    //テストエラー発生時、依存性のあるメソッドがスキップされることを確認
    // testSkipOne()の結果がfalseの時、testSkipTwoのテストはスキップされる。
    public function testSkipOne()
    {
        $this->assertTrue(true);
    }

    /**
     * @depends testSkipOne
     */
    public function testSkipTwo()
    {
        $this->assertTrue(true);
    }

    // 複数の依存性があるテスト
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
     **/
     public function testConsumer($a, $b)
     {
         $this->assertSame('first', $a);
         $this->assertSame('second', $b);
     }

}
