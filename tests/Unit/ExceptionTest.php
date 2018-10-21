<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExceptionTest extends TestCase
{

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
    }

    // アノテーションの使用法
    /**
     * @expectedException InvalidArgumentException
     ***/
    public function testException1()
    {

    }

    // PHPのエラーのテスト
    /**
     * @expectedException PHPUnit\Framework\Error\Error
     ***/
    public function testFailingInclude()
    {
        include 'vim.php';
    }
}
