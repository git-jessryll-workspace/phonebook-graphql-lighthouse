<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $loginService;

    /**
     * @param LoginApiService $loginService
     */
    public function __construct(LoginApiService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->loginService->login($request);
    }
}
