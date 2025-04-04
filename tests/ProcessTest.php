<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Process;

class ProcessTest extends TestCase
{
    public function testProcessRunsCorrectly(): void
    {
        $process = new Process(__DIR__ . '/files/file.teste');
        $result = $process->run();

        $expectedResults = [2, 7];
        $this->assertEquals($expectedResults, $result);
    }
}
