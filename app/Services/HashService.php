<?php

namespace App\Services;

use App\Repositories\HashRepository;

/**
 * @method string calculate(string $term)
 * @method bool isValid(string $hash)
 * @method string generate(string $key)
 */
class HashService
{
    public $keyService;
    public $attempts;
    private $hashRepository;

    public function __construct(
        KeyService $keyService,
        HashRepository $hashRepository
    )
    {
        $this->keyService = $keyService;
        $this->attempts = 0;
        $this->hashRepository = $hashRepository;
    }

    /**
     * Calcula um hash válido seguindo as regras:
     * Recebido um termo, onde é concatenado com uma chave
     * de 8 caracteres gerada aleatoriamente, onde essa string
     * é chamada de chave. Gera um md5 para essa chave gerada
     * onde é chamado de hash.
     *
     * Para um hash ser considerado válido, é necessário que os 4
     * primeiros caracteres seja '0000'
     *
     * @param string $term
     *
     * @return string
     */
    public function calculate(string $term): string
    {
        do {
            $hash = $this->generate(
                $this->keyService->generate($term)
            );
        } while (! $this->isValid($hash));

        $this->hashRepository->create(
            $term,
            $this->keyService->key,
            $hash,
            $this->attempts
        );

        return $hash;
    }

    /**
     * Verifica se o hash gerado é válido. Para ser considerado válido
     * é necessário que o hash tenha '0000' em seus 4 primeiros caracteres
     *
     * @param string $hash
     *
     * @return bool
     */
    public function isValid(string $hash): bool
    {
        $this->attempts++;
        if (substr($hash, 0, 4) === "0000") {
            return true;
        }

        return false;
    }

    /**
     * Gera um hash com base na key informada
     *
     * @param string $key
     *
     * @return string
     */
    public function generate(string $key): string
    {
        return md5($key);
    }
}
