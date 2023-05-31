<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\IconService;
use App\Http\Services\Api\V1\ResponseService;

class IconController extends Controller
{
    /**
     * IconController constructor.
     * @param IconService $iconService
     */
    public function __construct(private IconService $iconService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/icons",
     *      operationId="Icons",
     *      tags={"Icons"},
     *      summary="Get list of icons",
     *      description="Returns list of icons",
     *      @OA\Parameter(
     *          name="lang",
     *          description="languages: en, ru, uk",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example="true"),
     *              @OA\Property(property="errors", type="object"),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                      property="icons",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Article"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/icons/1657500102_youtube.png"),
     *                          @OA\Property(property="link", type="string", maxLength=255, example="https://www.youtube.com/"),
     *                      ),
     *                  ),
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
                'icons' => $this->iconService->getIcons()
            ]
        );
    }

}
