<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\FileValidator;
use App\Silhouettes;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function processFile(string $filePath): void
{
    if (!FileValidator::validateMimeType($filePath)) {
        echo "Invalid file type!" . PHP_EOL;
        return;
    }

    if (!FileValidator::validateFileStructure($filePath)) {
        echo "Malformed file structure!" . PHP_EOL;
        return;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    $cases = (int) array_shift($lines);
    $results = [];

    for ($i = 0; $i < $cases; $i++) {
        array_shift($lines);
        $silhouettes = array_map('intval', explode(' ', array_shift($lines)));

        $silhouettesCalc = new Silhouettes($silhouettes);
        $results[] = $silhouettesCalc->calculateFilling();
    }

    foreach ($results as $result) {
        echo $result . PHP_EOL;
    }
}

$directory = __DIR__ . DIRECTORY_SEPARATOR . $_ENV['FILE_DIRECTORY'] . DIRECTORY_SEPARATOR;
$fileExtension = $_ENV['FILE_EXTENSION'];
$files = glob($directory . '*' . $fileExtension);

foreach ($files as $file) {
    processFile($file);
}
