<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\EnvConfig;
use App\Process;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$directory = EnvConfig::getFileDirectory();
$extension = EnvConfig::getFileExtension();
$files = glob($directory . '*' . $extension);
$files = is_array($files) ? $files : [];

try {
    foreach ($files as $file) {
        $process = new Process($file);
        $result = $process->run();
        echo implode(PHP_EOL, $result);
    }
} catch (\RuntimeException $e) {
    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}
