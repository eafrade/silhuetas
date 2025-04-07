<?php

declare(strict_types=1);

namespace Tests;

use App\EnvConfig;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

final class EnvConfigTest extends TestCase
{
    protected function setUp(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '.env.phpunit');
        $dotenv->load();
    }

    public function testBasePathCorrect(): void
    {
        $expected = dirname(__DIR__);
        $this->assertSame($expected, EnvConfig::basePath());
    }

    public function testBasePathConstant(): void
    {
        define('BASE_PATH', '/test/xpto');
        $this->assertSame('/test/xpto', EnvConfig::basePath());
    }

    public function testResolvePathAppendsBasePath(): void
    {
        $relative = 'test/xpto';
        $expected = EnvConfig::basePath() . '/test/xpto';

        $this->assertSame($expected, EnvConfig::resolvePath($relative));
    }

    public function testGetFileDirectory(): void
    {
        $_ENV['FILE_DIRECTORY'] = 'test';
        $expected = EnvConfig::resolvePath('test') . '/';

        $this->assertSame($expected, EnvConfig::getFileDirectory());
    }

    public function testEmptyFileDirectory(): void
    {
        unset($_ENV['FILE_DIRECTORY']);
        $_ENV['FILE_EXTENSION'] = '.test';

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('FILE_DIRECTORY is not properly defined in the .env file.');

        EnvConfig::getFileDirectory();
    }

    public function testGetFileExtension(): void
    {
        $_ENV['FILE_EXTENSION'] = '.test';
        $this->assertSame('.test', EnvConfig::getFileExtension());
    }

    public function testEmptyFileExtension(): void
    {
        $_ENV['FILE_DIRECTORY'] = 'test/xpto';
        unset($_ENV['FILE_EXTENSION']);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('FILE_EXTENSION is not properly defined in the .env file.');

        EnvConfig::getFileExtension();
    }
}
