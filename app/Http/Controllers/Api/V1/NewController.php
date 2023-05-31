<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\NewService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class NewController extends Controller
{
    /**
     * NewController constructor.
     * @param NewService $newService
     */
    public function __construct(private NewService $newService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/news",
     *      operationId="News",
     *      tags={"News"},
     *      summary="Get list of news",
     *      description="Returns list of news",
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
     *                      property="news",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="slug", type="string", maxLength=255, example="article"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Article"),
     *                          @OA\Property(property="short_body", type="string", example="article"),
     *                          @OA\Property(property="body", type="string", example="article"),
     *                          @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/articles/1661447186_coollogo_com-9344724"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/articles/1661447186_coollogo_com-9344724.jpg"),
     *                          @OA\Property(property="meta_title", type="string", maxLength=255, example="article"),
     *                          @OA\Property(property="meta_keywords", type="string", maxLength=255, example="article"),
     *                          @OA\Property(property="meta_description", type="string", example="article"),
     *                          @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
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
                'news' => $this->newService->getNews($request->get('lang'))
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/news/{slug}",
     *      operationId="New",
     *      tags={"News"},
     *      summary="Get New",
     *      description="Returns New",
     *      @OA\Parameter(
     *          name="slug",
     *          description="New slug",
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
     *                  @OA\Property(property="new", type="object", ref="#/components/schemas/News"),
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
                'new' => $this->newService->getNew(
                    $request->get('lang'),
                    $slug
                )
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/news/home",
     *      operationId="NewHome",
     *      tags={"News"},
     *      summary="Get New home",
     *      description="Returns New home",
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
     *                      property="news",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="slug", type="string", maxLength=255, example="article"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Article"),
     *                          @OA\Property(property="short_body", type="string", example="article"),
     *                          @OA\Property(property="body", type="string", example="article"),
     *                          @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/articles/1661447186_coollogo_com-9344724"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/articles/1661447186_coollogo_com-9344724.jpg"),
     *                          @OA\Property(property="meta_title", type="string", maxLength=255, example="article"),
     *                          @OA\Property(property="meta_keywords", type="string", maxLength=255, example="article"),
     *                          @OA\Property(property="meta_description", type="string", example="article"),
     *                          @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                      ),
     *                  ),
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
                'news' => $this->newService->getHome($request->get('lang'))
            ]
        );
    }

}
