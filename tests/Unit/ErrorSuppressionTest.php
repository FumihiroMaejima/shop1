<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ErrorSuppressionTest extends TestCase
{

    // PHPのエラーコードが発生するコードの返り値
    public function testFileWriting()
    {
        $writer = new FileWriter;

        $this->assertfalse(@$writer->write('/is-not-writeable/file', 'stuff'));
    }
}

class FileWriter
{
    public function write($file, $content)
    {
        $file = fopen($file, 'w');

        if($file == false)
        {
            return false;
        }
    }
}
