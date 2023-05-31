<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\HomeService;
use App\Http\Services\Api\V1\ResponseService;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     * @param HomeService $homeService
     */
    public function __construct(private HomeService $homeService)
    {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'items' => $this->homeService->index()
            ]
        );
    }
}
