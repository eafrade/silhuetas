<?php

declare(strict_types=1);

namespace App;

use App\FileValidator;
use App\Silhouettes;

class Process
{
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function run(): array
    {
        if (!FileValidator::validateMimeType($this->filename)) {
            throw new \RuntimeException("Invalid file type: {$this->filename}");
        }

        if (!FileValidator::validateFileStructure($this->filename)) {
            throw new \RuntimeException("Malformed file structure!: {$this->filename}");
        }

        $lines = file($this->filename, FILE_IGNORE_NEW_LINES);
        $cases = (int) array_shift($lines);
        $results = [];

        for ($i = 0; $i < $cases; $i++) {
            array_shift($lines);
            $silhouettes = array_map('intval', explode(' ', array_shift($lines)));

            $silhouettesCalc = new Silhouettes($silhouettes);
            $results[] = $silhouettesCalc->calculateFilling();
        }

        return $results;
    }
}
