<?php

declare(strict_types=1);

namespace Tests;

use App\Silhouettes;
use PHPUnit\Framework\TestCase;

class SilhouettesTest extends TestCase
{
    public function testCalculateFillingSimple()
    {
        $silhouettes = new Silhouettes([3, 1, 3]);
        $this->assertEquals(2, $silhouettes->calculateFilling());
    }

    public function testCalculateNoFilling()
    {
        $silhouettes = new Silhouettes([1, 2, 3]);
        $this->assertEquals(0, $silhouettes->calculateFilling());
    }

    public function testCalculateFillingMany()
    {
        $silhouettes = new Silhouettes([4, 1, 2, 1, 3]);
        $this->assertEquals(5, $silhouettes->calculateFilling());
    }

    public function testCalculateNoFillingEnd()
    {
        $silhouettes = new Silhouettes([3, 2, 1]);
        $this->assertEquals(0, $silhouettes->calculateFilling());
    }

    public function testCalculateWallFilling()
    {
        $silhouettes = new Silhouettes([4, 2, 5, 2, 3, 1, 2, 5]);
        $this->assertEquals(14, $silhouettes->calculateFilling());
    }
}
