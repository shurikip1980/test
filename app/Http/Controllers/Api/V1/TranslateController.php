<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ResponseService;
use App\Http\Services\Api\V1\TranslateService;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    /**
     * TranslateController constructor.
     * @param TranslateService $translateService
     */
    public function __construct(private TranslateService $translateService)
    {
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'translate' => $this->translateService->getTranslate($request->get('lang'))
            ]
        );
    }
}
