<?php

namespace App\Http\Controllers;

use App\Repositories\HashRepository;
use App\Services\HashService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * @method JsonResponse calculate(Request $request)
 * @method JsonResponse all()
 */
class HashController extends BaseController
{
    private $hashService;
    private $hashRepository;

    public function __construct(
        HashService $hashService,
        HashRepository $hashRepository
    )
    {
        $this->hashService = $hashService;
        $this->hashRepository = $hashRepository;
    }

    /**
     * Gera o hash
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function generate(Request $request): JsonResponse
    {
        $this->validate($request, [
            'term' => 'required'
        ]);

        return response()->json(
            [
                "hash" => $this->hashService->calculate($request->term),
                "attempts" => $this->hashService->attempts,
                "key" => $this->hashService->keyService->key
            ],
        200);
    }

    /**
     * Retorna uma lista com todos os hashes
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return response()->json(
            [
                "hashes" => $this->hashRepository->all()
            ],
        200);
    }
}
