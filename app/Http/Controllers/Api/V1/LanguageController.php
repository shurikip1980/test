<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\LanguageService;
use App\Http\Services\Api\V1\ResponseService;

class LanguageController extends Controller
{
    /**
     * LanguageController constructor.
     * @param LanguageService $languageService
     */
    public function __construct(private LanguageService $languageService)
    {
    }

        /**
         * @OA\Get(
         *      path="/api/languages",
         *      operationId="Languages",
         *      tags={"Languages"},
         *      summary="Get Languages",
         *      description="Returns Languages",
         *      @OA\Response(
         *          response=200,
         *          description="Success",
         *          @OA\JsonContent(
         *              @OA\Property(property="status", type="boolean", example="true"),
         *              @OA\Property(property="errors", type="object"),
         *              @OA\Property(
         *                  property="data",
         *                  type="object",
         *                  @OA\Property(property="languages", type="object", ref="#/components/schemas/Language"),
         *              )
         *          )
         *      ),
         * )
         */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'languages' => $this->languageService->getLanguages()
            ]
        );
    }

}
