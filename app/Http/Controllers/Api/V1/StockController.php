<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ResponseService;
use App\Http\Services\Api\V1\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * StockController constructor.
     * @param StockService $stockService
     */
    public function __construct(private StockService $stockService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/stocks",
     *      operationId="Stocks",
     *      tags={"Stocks"},
     *      summary="Get list of stocks",
     *      description="Returns list of stocks",
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
     *                      property="stocks",
     *                      type="object",
     *                      @OA\Property(property="current_page", type="integer", example="1"),
     *                      @OA\Property(
     *                          property="data",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                              @OA\Property(property="slug", type="string", maxLength=255, example="article"),
     *                              @OA\Property(property="name", type="string", maxLength=255, example="Article"),
     *                              @OA\Property(property="short_body", type="string", example="article"),
     *                              @OA\Property(property="body", type="string", example="article"),
     *                              @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/articles/1661447186_coollogo_com-9344724"),
     *                              @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/articles/1661447186_coollogo_com-9344724.jpg"),
     *                              @OA\Property(property="meta_title", type="string", maxLength=255, example="article"),
     *                              @OA\Property(property="meta_keywords", type="string", maxLength=255, example="article"),
     *                              @OA\Property(property="meta_description", type="string", example="article"),
     *                              @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                          ),
     *                      ),
     *                      @OA\Property(property="first_page_url", type="string", maxLength=255, example="https://localhost:80/api/stocks?page=1"),
     *                      @OA\Property(property="from", type="integer", example="1"),
     *                      @OA\Property(property="last_page", type="integer", example="6"),
     *                      @OA\Property(property="last_page_url", type="string", maxLength=255, example="https://localhost:80/api/stocks?page=6"),
     *                      @OA\Property(
     *                          property="links",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="url", type="string, null", maxLength=255, example="null"),
     *                              @OA\Property(property="label", type="string", maxLength=255, example="&laquo; Previous"),
     *                              @OA\Property(property="active", type="boolean", example="true"),
     *                          ),
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="url", type="string", maxLength=255, example="https://localhost:80/api/stocks?page=1"),
     *                              @OA\Property(property="label", type="string", maxLength=255, example="1"),
     *                              @OA\Property(property="active", type="boolean", example="false"),
     *                          ),
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="url", type="string", maxLength=255, example="https://localhost:80/api/stocks?page=6"),
     *                              @OA\Property(property="label", type="string", maxLength=255, example="6"),
     *                              @OA\Property(property="active", type="boolean", example="false"),
     *                          ),
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="url", type="string, null", maxLength=255, example="https://localhost:80/api/stocks?page=2"),
     *                              @OA\Property(property="label", type="string", maxLength=255, example="Next &raquo;"),
     *                              @OA\Property(property="active", type="boolean", example="false"),
     *                          ),
     *                      ),
     *                      @OA\Property(property="next_page_url", type="string, null", maxLength=255, example="https://localhost:80/api/stocks?page=2"),
     *                      @OA\Property(property="path", type="string", maxLength=255, example="https://localhost:80/api/stocks"),
     *                      @OA\Property(property="per_page", type="integer", example="2"),
     *                      @OA\Property(property="prev_page_url", type="string, null", maxLength=255, example="null"),
     *                      @OA\Property(property="to", type="integer", example="2"),
     *                      @OA\Property(property="total", type="integer", example="12"),
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
                'stocks' => $this->stockService->getStocks($request->get('lang'))
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/stocks/{slug}",
     *      operationId="Stock",
     *      tags={"Stocks"},
     *      summary="Get Stock",
     *      description="Returns Stock",
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
     *                  @OA\Property(property="stock", type="object", ref="#/components/schemas/Stock"),
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
                'stock' => $this->stockService->getStock(
                    $request->get('lang'),
                    $slug
                )
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/stocks/home",
     *      operationId="StockHome",
     *      tags={"Stocks"},
     *      summary="Get Stock home",
     *      description="Returns Stock home",
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
     *                      property="stocks",
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
                'stocks' => $this->stockService->getHome($request->get('lang'))
            ]
        );
    }
}
