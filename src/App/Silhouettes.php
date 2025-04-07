<?php

declare(strict_types=1);

namespace App;

class Silhouettes
{
    private array $silhouettes;

    public function __construct(array $silhouettes)
    {
        $this->silhouettes = $silhouettes;
    }

    public function calculateFilling(): int
    {
        $highest = max($this->silhouettes);
        $filling = 0;
        $reference = $this->silhouettes[0];

        foreach ($this->silhouettes as $index => $silhouette) {
            if ($silhouette > $reference) {
                $reference = $silhouette;
            } else {
                if ($highest == $reference) {
                    $highest = max(array_slice($this->silhouettes, $index));
                    $reference = $highest;
                }
            }

            if ($silhouette < $reference) {
                $filling += $reference - $silhouette;
            }
        }
        return $filling;
    }
}
