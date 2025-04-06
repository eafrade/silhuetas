<?php

declare(strict_types=1);

namespace Tests;

use App\FileValidator;
use PHPUnit\Framework\TestCase;

class FileValidatorTest extends TestCase
{
    public function testInvalidMimeType(): void
    {
        $filePath = __DIR__ . '/files/file-pdf.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

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

    public function testInvalidIntCase(): void
    {
        $filePath = __DIR__ . '/files/no_int_case.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    public function testInvalidCaseCount(): void
    {
        $filePath = __DIR__ . '/files/case_count.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    public function testInvalidArraySeparator(): void
    {
        $filePath = __DIR__ . '/files/array_separator.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    public function testInvalidNoIntArray(): void
    {
        $filePath = __DIR__ . '/files/array_no_int.teste';
        $this->assertFalse(FileValidator::validateFileStructure($filePath));
    }

    public function testValidFile(): void
    {
        $filePath = __DIR__ . '/files/file.teste';
        $this->assertTrue(FileValidator::validateFileStructure($filePath));
    }
}
