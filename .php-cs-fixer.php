<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'ordered_imports' => true,
        'no_unused_imports' => true,
        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],
        'declare_strict_types' => true
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
