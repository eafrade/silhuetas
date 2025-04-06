<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Process;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$directory = __DIR__ . DIRECTORY_SEPARATOR . $_ENV['FILE_DIRECTORY'] . DIRECTORY_SEPARATOR;
$fileExtension = $_ENV['FILE_EXTENSION'];
$files = glob($directory . '*' . $fileExtension);

try {
    foreach ($files as $file) {
        $process = new Process($file);
        $result = $process->run();
        echo implode(PHP_EOL, $result);
    }
} catch (\RuntimeException $e) {
    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}
