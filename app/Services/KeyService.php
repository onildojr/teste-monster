<?php

namespace App\Services;

/**
 * @method string generate(string $term)
 */
class KeyService
{
    public $key;

    /**
     * Gera uma chave aleatória com 4 bytes (8 caracteres)
     *
     * @param string $term
     *
     * @return string
     */
    public function generate(string $term): string
    {
        $this->key = bin2hex(
            random_bytes(4)
        );

        return $term.$this->key;
    }
}
