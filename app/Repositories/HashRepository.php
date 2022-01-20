<?php

namespace App\Repositories;

use App\Models\Hash;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method Hash create(string $inputString, string $key, string $hash, int $attempts)
 * @method Collection all()
 */
class HashRepository
{
    protected $hash;

    public function __construct(Hash $hash)
    {
        $this->hash = $hash;
    }

    /**
     * Cria um resource para a Model hash
     *
     * @param string $inputString
     * @param string $key
     * @param string $hash
     * @param int $attempts
     *
     * @return Hash
     */
    public function create(
        string $inputString,
        string $key,
        string $hash,
        int $attempts
    ): Hash
    {
        $hash = $this->hash->create([
            'input_string' => $inputString,
            'key' => $key,
            'hash' => $hash,
            'attempts' => $attempts
        ]);

        return $hash;
    }

    /**
     * Retorna todos os hashs
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->hash->all();
    }
}
