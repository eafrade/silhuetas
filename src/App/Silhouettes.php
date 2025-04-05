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
        $maior = max($this->silhouettes);
        $preenchimento = 0;
        $referencia = $this->silhouettes[0];

        foreach ($this->silhouettes as $index => $silhueta) {
            if ($silhueta > $referencia) {
                $referencia = $silhueta;
            } else {
                if ($maior == $referencia) {
                    $maior = max(array_slice($this->silhouettes, $index));
                    $referencia = $maior;
                }
            }

            if ($silhueta < $referencia) {
                $preenchimento += $referencia - $silhueta;
            }
        }
        return $preenchimento;
    }
}
