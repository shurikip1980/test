<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\CategoryService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(private CategoryService $categoryService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/categories",
     *      operationId="Categories",
     *      tags={"Categories"},
     *      summary="Get list of categories",
     *      description="Returns list of categories",
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
     *                      property="categories",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="slug", type="string", maxLength=255, example="stiralnye-poroshki"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Washing powders"),
     *                          @OA\Property(property="image", type="string", example="1656187120_o2dvsv2pnhe"),
     *                          @OA\Property(property="type_img", type="string", example="jpg"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/categories/1656187120_o2dvsv2pnhe.jpg"),
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
                'categories' => $this->categoryService->index($request->get('lang'))
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/categories/{slug}",
     *      operationId="Category",
     *      tags={"Categories"},
     *      summary="Get category",
     *      description="Returns category",
     *      @OA\Parameter(
     *          name="slug",
     *          description="Category slug",
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
     *                      property="category",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="slug", type="string", maxLength=255, example="stiralnye-poroshki"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Washing powders"),
     *                          @OA\Property(property="body", type="string", example="Washing powders"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                          @OA\Property(property="meta_title", type="string", maxLength=255, example="Washing powders"),
     *                          @OA\Property(property="meta_keywords", type="string", maxLength=255, example="Washing powders"),
     *                          @OA\Property(property="meta_description", type="string", example="Washing powders"),
     *                          @OA\Property(
     *                              property="api_products",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                  @OA\Property(property="slug", type="string", maxLength=255, example="stiralnyj-poroshok-dlya-novorozhdennyh-2kg"),
     *                                  @OA\Property(property="name", type="string", maxLength=255, example="Laundry detergent for newborns, 2kg"),
     *                                  @OA\Property(property="code", type="integer", example="7425"),
     *                                  @OA\Property(property="price", type="integer", example="250.00"),
     *                                  @OA\Property(property="price_old", type="integer", example="150.00"),
     *                                  @OA\Property(property="count_product", type="integer", example="6"),
     *                                  @OA\Property(
     *                                      property="img",
     *                                      type="array",
     *                                      @OA\Items(
     *                                          type="object",
     *                                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                                          @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/products/1661446710_coollogo_com-14608366"),
     *                                          @OA\Property(property="image", type="string", maxLength=255, example="1661446710_coollogo_com-14608366"),
     *                                          @OA\Property(property="type_img", type="string", maxLength=255, example="jpg"),
     *                                          @OA\Property(property="product_id", type="integer", readOnly="true", example="1"),
     *                                          @OA\Property(property="main_img", type="integer", example="1"),
     *                                          @OA\Property(property="numeral", type="integer", example="1"),
     *                                      ),
     *                                  ),
     *                                  @OA\Property(
     *                                      property="comments",
     *                                      type="array",
     *                                      @OA\Items(
     *                                          type="object",
     *                                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                          @OA\Property(property="name", type="string", maxLength=255, example="Shurik"),
     *                                          @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
     *                                          @OA\Property(property="rating", type="integer", example="5"),
     *                                          @OA\Property(property="text", type="string", maxLength=255, example="Text"),
     *                                          @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                                          @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
     *                                      ),
     *                                  ),
     *                                  @OA\Property(
     *                                      property="features",
     *                                      type="array",
     *                                      @OA\Items(
     *                                          type="object",
     *                                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                          @OA\Property(property="name", type="string", maxLength=255, example="Alenka"),
     *                                      ),
     *                                  ),
     *                              ),
     *                          ),
     *                      ),
     *                  ),
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
                'category' => $this->categoryService->show(
                    $request->get('lang'),
                    $slug
                )
            ]
        );
    }


    /**
     * @OA\Get(
     *      path="/api/categories/{id}/homeProducts",
     *      operationId="CategoryHomeProducts",
     *      tags={"Categories"},
     *      summary="Get category home Products",
     *      description="Returns category home Products",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
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
     *                      property="category",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="slug", type="string", maxLength=255, example="stiralnye-poroshki"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Washing powders"),
     *                          @OA\Property(property="body", type="string", example="Washing powders"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                          @OA\Property(property="meta_title", type="string", maxLength=255, example="Washing powders"),
     *                          @OA\Property(property="meta_keywords", type="string", maxLength=255, example="Washing powders"),
     *                          @OA\Property(property="meta_description", type="string", example="Washing powders"),
     *                          @OA\Property(
     *                              property="api_products",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                  @OA\Property(property="slug", type="string", maxLength=255, example="stiralnyj-poroshok-dlya-novorozhdennyh-2kg"),
     *                                  @OA\Property(property="name", type="string", maxLength=255, example="Laundry detergent for newborns, 2kg"),
     *                                  @OA\Property(property="code", type="integer", example="7425"),
     *                                  @OA\Property(property="price", type="integer", example="250.00"),
     *                                  @OA\Property(property="price_old", type="integer", example="150.00"),
     *                                  @OA\Property(property="count_product", type="integer", example="6"),
     *                                  @OA\Property(
     *                                      property="img",
     *                                      type="array",
     *                                      @OA\Items(
     *                                          type="object",
     *                                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                                          @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/products/1661446710_coollogo_com-14608366"),
     *                                          @OA\Property(property="image", type="string", maxLength=255, example="1661446710_coollogo_com-14608366"),
     *                                          @OA\Property(property="type_img", type="string", maxLength=255, example="jpg"),
     *                                          @OA\Property(property="product_id", type="integer", readOnly="true", example="1"),
     *                                          @OA\Property(property="main_img", type="integer", example="1"),
     *                                          @OA\Property(property="numeral", type="integer", example="1"),
     *                                      ),
     *                                  ),
     *                                  @OA\Property(
     *                                      property="comments",
     *                                      type="array",
     *                                      @OA\Items(
     *                                          type="object",
     *                                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                          @OA\Property(property="name", type="string", maxLength=255, example="Shurik"),
     *                                          @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
     *                                          @OA\Property(property="rating", type="integer", example="5"),
     *                                          @OA\Property(property="text", type="string", maxLength=255, example="Text"),
     *                                          @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                                          @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
     *                                      ),
     *                                  ),
     *                                  @OA\Property(
     *                                      property="features",
     *                                      type="array",
     *                                      @OA\Items(
     *                                          type="object",
     *                                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                          @OA\Property(property="name", type="string", maxLength=255, example="Alenka"),
     *                                      ),
     *                                  ),
     *                              ),
     *                          ),
     *                      ),
     *                  ),
     *              )
     *          )
     *      ),
     * )
     */
    public function homeProducts(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'category' => $this->categoryService->getHomeProducts(
                    $request->get('lang'),
                    $id
                )
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/categories/home",
     *      operationId="CategoriesHome",
     *      tags={"Categories"},
     *      summary="Get list of categories home",
     *      description="Returns list of categories home",
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
     *                      property="categories",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="slug", type="string", maxLength=255, example="stiralnye-poroshki"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Washing powders"),
     *                          @OA\Property(property="image", type="string", example="1656187120_o2dvsv2pnhe"),
     *                          @OA\Property(property="type_img", type="string", example="jpg"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/categories/1656187120_o2dvsv2pnhe.jpg"),
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
                'categories' => $this->categoryService->home($request->get('lang'))
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/categories/{id}/features/",
     *      operationId="CategoryFeatures",
     *      tags={"Categories"},
     *      summary="Get Category Features",
     *      description="Returns Category Features",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
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
     *                     property="features",
     *                     type="array",
     *                     @OA\Items(
     *                       type="object",
     *                       @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                       @OA\Property(property="name", type="string", maxLength=255, example="Trademark"),
     *                       @OA\Property(
     *                          property="children",
     *                          type="array",
     *                          @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                             @OA\Property(property="name", type="string", maxLength=255, example="Alenka"),
     *                          ),
     *                       ),
     *                     ),
     *                 ),
     *              )
     *          )
     *      ),
     * )
     */
    public function features(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'features' => $this->categoryService->getFeatures(
                    $request->get('lang'),
                    $id
                )
            ]
        );
    }
}
