<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\PageService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * PageController constructor.
     * @param PageService $pageService
     */
    public function __construct(private PageService $pageService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/pages",
     *      operationId="Pages",
     *      tags={"Pages"},
     *      summary="Get list of pages",
     *      description="Returns list of pages",
     *      @OA\Parameter(
     *          name="type",
     *          description="Pages type: main, footer",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
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
     *                      property="pages",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="slug", type="string", maxLength=255, example="home"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="About Us"),
     *                      ),
     *                  ),
     *              )
     *          )
     *      ),
     * )
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'pages' => $this->pageService->index(
                    $request->get('type'),
                    $request->get('lang')
                )
            ]
        );
    }


    /**
     * @OA\Get(
     *      path="/api/pages/{slug}",
     *      operationId="Page",
     *      tags={"Pages"},
     *      summary="Get Page",
     *      description="Returns Page",
     *      @OA\Parameter(
     *          name="slug",
     *          description="Page slug",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
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
     *                  @OA\Property(property="page", type="object", ref="#/components/schemas/Page"),
     *              )
     *          )
     *      ),
     * )
     */
    public function show(Request $request, $slug): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'page' => $this->pageService->show(
                    $request->get('lang'),
                    $slug
                )
            ]
        );
    }


    /**
     * @OA\Get(
     *      path="/api/pages/home",
     *      operationId="PageHome",
     *      tags={"Pages"},
     *      summary="Get Page home",
     *      description="Returns Page home",
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
     *                  @OA\Property(property="page", type="object", ref="#/components/schemas/Page"),
     *              )
     *          )
     *      ),
     * )
     */
    public function home(Request $request): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'page' => $this->pageService->home($request->get('lang'))
            ]
        );
    }
}
