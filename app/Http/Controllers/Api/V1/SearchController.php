<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ResponseService;
use App\Http\Services\Api\V1\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * SearchController constructor.
     * @param SearchService $searchService
     */
    public function __construct(private SearchService $searchService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/search",
     *      operationId="Search",
     *      tags={"Search"},
     *      summary="Get Products",
     *      description="Returns Products",
     *      @OA\Parameter(
     *          name="search",
     *          description="Products search",
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
     *                  @OA\Property(
     *                      property="products",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="parent", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Laundry detergent for newborns, 2kg"),
     *                          @OA\Property(property="slug", type="string", maxLength=255, example="stiralnyj-poroshok-dlya-novorozhdennyh-2kg"),
     *                          @OA\Property(property="code", type="integer", readOnly="true", example="5858585"),
     *                          @OA\Property(property="price", type="integer", readOnly="true", example="250.00"),
     *                          @OA\Property(property="price_old", type="integer", readOnly="true", example="150.00"),
     *                          @OA\Property(property="currency_id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="count_product", type="integer", readOnly="true", example="25"),
     *                          @OA\Property(
     *                              property="img",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                  @OA\Property(property="main_img", type="integer", readOnly="true", example="1"),
     *                                  @OA\Property(property="numeral", type="integer", readOnly="true", example="1"),
     *                                  @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/products/1661446710_coollogo_com-14608366.jpg"),
     *                              ),
     *                          ),
     *                      ),
     *                  ),
     *              )
     *          )
     *      ),
     * )
     */
    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'products' => $this->searchService->getProducts(
                    $request->get('lang'),
                    $request->get('search')
                )
            ]
        );
    }
}
