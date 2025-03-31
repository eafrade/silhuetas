<?php

declare(strict_types=1);

namespace App;

class FileValidator
{
    public static function validateMimeType(string $filePath): bool
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);

        return $mimeType === 'text/plain';
    }

    public static function validateFileStructure(string $filePath): bool
    {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES);
        if (!$lines || !is_numeric($lines[0])) {
            return false;
        }

        $numCases = (int) array_shift($lines);
        if ($numCases < 1 || $numCases > 100) {
            return false;
        }

        for ($i = 0; $i < $numCases; $i++) {
            if (!isset($lines[0], $lines[1]) || !is_numeric($lines[0])) {
                return false;
            }

            $firstLine = (int) array_shift($lines);
            $secondLine = array_shift($lines);

            if (!preg_match('/^[0-9 ]+$/', $secondLine)) {
                return false;
            }

            $secondLineItems = explode(' ', $secondLine);
            $numItems = count($secondLineItems);
            if ($numItems !== $firstLine) {
                return false;
            }
        }
        return empty($lines);
    }
}
