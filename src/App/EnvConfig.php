<?php

declare(strict_types=1);

namespace App;

final class EnvConfig
{
    public static function basePath(): string
    {
        return defined('BASE_PATH') ? BASE_PATH : \dirname(__DIR__, 2);
    }

    public static function resolvePath(string $relative): string
    {
        return \rtrim(self::basePath(), '/') . '/' . \ltrim($relative, '/');
    }

    public static function getFileDirectory(): string
    {
        $directory = $_ENV['FILE_DIRECTORY'] ?? null;

        if (!\is_string($directory)) {
            throw new \RuntimeException('FILE_DIRECTORY is not properly defined in the .env file.');
        }

        return self::resolvePath($directory) . '/';
    }

    public static function getFileExtension(): string
    {
        $extension = $_ENV['FILE_EXTENSION'] ?? null;

        if (!\is_string($extension)) {
            throw new \RuntimeException('FILE_EXTENSION is not properly defined in the .env file.');
        }

        return $extension;
    }
}
