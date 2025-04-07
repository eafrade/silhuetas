<?php

declare(strict_types=1);

namespace Tests;

use App\Process;
use PHPUnit\Framework\TestCase;

class ProcessTest extends TestCase
{
    public function testProcessInvalidMimeType(): void
    {
        $filePath = __DIR__ . '/files/file-pdf.teste';
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Invalid file type: {$filePath}");

        $process = new Process($filePath);
        $process->run();
    }

    public function testProcessInvalidStructure(): void
    {
        $filePath = __DIR__ . '/files/item_count.teste';
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Malformed file structure!: {$filePath}");

        $process = new Process($filePath);
        $process->run();
    }

    public function testProcessRunsCorrect(): void
    {
        $filePath = __DIR__ . '/files/file.teste';
        $process = new Process($filePath);
        $result = $process->run();

        $expectedResults = [2, 7];
        $this->assertEquals($expectedResults, $result);
    }
}
