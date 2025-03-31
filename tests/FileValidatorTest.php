<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\FileValidator;

class FileValidatorTest extends TestCase
{
    public function testInvalidItemCount(): void
    {
        $filePath = __DIR__ . '/files/item_count.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    public function testCasesOutOfRange0(): void
    {
        $filePath = __DIR__ . '/files/range_0.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    public function testCasesOutOfRange100(): void
    {
        $filePath = __DIR__ . '/files/range_100.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    public function testInvalidCaseCount(): void
    {
        $filePath = __DIR__ . '/files/case_count.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    public function testValidFile(): void
    {
        $filePath = __DIR__ . '/files/file.teste';
        $this->assertTrue(FileValidator::validateFileStructure($filePath));
    }
}
