<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ArticleService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(private ArticleService $articleService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/articles",
     *      operationId="Articles",
     *      tags={"Articles"},
     *      summary="Get list of articles",
     *      description="Returns list of articles",
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
     *                      property="articles",
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
                'articles' => $this->articleService->getArticles($request->get('lang'))
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/articles/{slug}",
     *      operationId="Article",
     *      tags={"Articles"},
     *      summary="Get Article",
     *      description="Returns Article",
     *      @OA\Parameter(
     *          name="slug",
     *          description="Article slug",
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
     *                  @OA\Property(property="article", type="object", ref="#/components/schemas/Article"),
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
                'article' => $this->articleService->getArticle(
                    $request->get('lang'),
                    $slug
                )
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/articles/home",
     *      operationId="ArticleHome",
     *      tags={"Articles"},
     *      summary="Get Article home",
     *      description="Returns Article home",
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
     *                      property="articles",
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
                'articles' => $this->articleService->getHome($request->get('lang'))
            ]
        );
    }
}
