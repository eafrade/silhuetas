<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\FileValidator;

class FileValidatorTest extends TestCase
{
    // Test case where the number of cases is different from the number of items in the second line
    public function testInvalidItemCount(): void
    {
        $filePath = __DIR__ . '/files/item_count.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    // Test case where the number of cases exceeds the valid range (1-100)
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

    // Test case where the number of cases is not within the valid range (1-100)
    public function testInvalidCaseCount(): void
    {
        $filePath = __DIR__ . '/files/case_count.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    // Test case with valid structure
    public function testValidFile(): void
    {
        $filePath = __DIR__ . '/files/file.teste';
        $this->assertTrue(FileValidator::validateFileStructure($filePath));
    }
}
