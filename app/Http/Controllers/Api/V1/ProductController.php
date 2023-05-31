<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CommentRequest;
use App\Http\Services\Api\V1\ProductService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(private ProductService $productService)
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
                'products' => $this->productService->getProducts()
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/products/{slug}",
     *      operationId="Product",
     *      tags={"Products"},
     *      summary="Get Product",
     *      description="Returns Product",
     *      @OA\Parameter(
     *          name="slug",
     *          description="Product slug",
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
     *                      property="product",
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                      @OA\Property(property="slug", type="string", maxLength=255, example="stiralnyj-poroshok-dlya-novorozhdennyh-2kg"),
     *                      @OA\Property(property="name", type="string", maxLength=255, example="Laundry detergent for newborns, 2kg"),
     *                      @OA\Property(property="code", type="integer", example="7425"),
     *                      @OA\Property(property="price", type="integer", example="250.00"),
     *                      @OA\Property(property="price_old", type="integer", example="150.00"),
     *                      @OA\Property(property="count_product", type="integer", example="6"),
     *                      @OA\Property(property="short_body", type="string", example="Washing powders"),
     *                      @OA\Property(property="body", type="string", example="Washing powders"),
     *                      @OA\Property(property="info", type="string", example="Washing powders"),
     *                      @OA\Property(property="shipping_payment", type="string", example="Washing powders"),
     *                      @OA\Property(property="meta_title", type="string", maxLength=255, example="Washing powders"),
     *                      @OA\Property(property="meta_keywords", type="string", maxLength=255, example="Washing powders"),
     *                      @OA\Property(property="meta_description", type="string", example="Washing powders"),
     *                      @OA\Property(
     *                          property="alike",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                              @OA\Property(property="slug", type="string", maxLength=255, example="stiralnyj-poroshok-dlya-novorozhdennyh-2kg"),
     *                              @OA\Property(property="name", type="string", maxLength=255, example="Laundry detergent for newborns, 2kg"),
     *                              @OA\Property(property="code", type="integer", example="7425"),
     *                              @OA\Property(property="price", type="integer", example="250.00"),
     *                              @OA\Property(property="price_old", type="integer", example="150.00"),
     *                              @OA\Property(property="count_product", type="integer", example="6"),
     *                              @OA\Property(property="short_body", type="string", example="Washing powders"),
     *                              @OA\Property(property="info_img", type="string", example="450 gr"),
     *                              @OA\Property(
     *                                  property="img",
     *                                  type="array",
     *                                  @OA\Items(
     *                                      type="object",
     *                                      @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                      @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                                      @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/products/1661446710_coollogo_com-14608366"),
     *                                      @OA\Property(property="image", type="string", maxLength=255, example="1661446710_coollogo_com-14608366"),
     *                                      @OA\Property(property="type_img", type="string", maxLength=255, example="jpg"),
     *                                      @OA\Property(property="product_id", type="integer", readOnly="true", example="1"),
     *                                      @OA\Property(property="main_img", type="integer", example="1"),
     *                                      @OA\Property(property="numeral", type="integer", example="1"),
     *                                  ),
     *                              ),
     *                              @OA\Property(
     *                                  property="comments",
     *                                  type="array",
     *                                  @OA\Items(
     *                                      type="object",
     *                                      @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                      @OA\Property(property="name", type="string", maxLength=255, example="Shurik"),
     *                                      @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
     *                                      @OA\Property(property="rating", type="integer", example="5"),
     *                                      @OA\Property(property="text", type="string", maxLength=255, example="Text"),
     *                                      @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                                      @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
     *                                  ),
     *                              ),
     *                          ),
     *                      ),
     *                      @OA\Property(
     *                         property="specification",
     *                         type="array",
     *                         @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="name", type="string", maxLength=255, example="the weight"),
     *                              @OA\Property(property="value", type="string", maxLength=255, example="2 kg"),
     *                         ),
     *                      ),
     *                      @OA\Property(
     *                         property="category",
     *                         type="array",
     *                         @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                              @OA\Property(property="name", type="string", maxLength=255, example="Washing powders"),
     *                              @OA\Property(property="slug", type="string", maxLength=255, example="stiralnye-poroshki"),
     *                         ),
     *                      ),
     *                      @OA\Property(
     *                         property="img",
     *                         type="array",
     *                         @OA\Items(
     *                            type="object",
     *                            @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                            @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                            @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/products/1661446710_coollogo_com-14608366"),
     *                            @OA\Property(property="image", type="string", maxLength=255, example="1661446710_coollogo_com-14608366"),
     *                            @OA\Property(property="type_img", type="string", maxLength=255, example="jpg"),
     *                            @OA\Property(property="product_id", type="integer", readOnly="true", example="1"),
     *                            @OA\Property(property="main_img", type="integer", example="1"),
     *                            @OA\Property(property="numeral", type="integer", example="1"),
     *                          ),
     *                       ),
     *                       @OA\Property(
     *                          property="comments",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                              @OA\Property(property="name", type="string", maxLength=255, example="Shurik"),
     *                              @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
     *                              @OA\Property(property="rating", type="integer", example="5"),
     *                              @OA\Property(property="text", type="string", maxLength=255, example="Text"),
     *                              @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                              @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
     *                          ),
     *                       ),
     *                    ),
     *                 ),
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
                'product' => $this->productService->getProduct(
                    $request->get('lang'),
                    $slug
                )
            ]
        );
    }

    /**
     * @OA\Post(
     *      path="/api/products/{id}/comment",
     *      operationId="Comment",
     *      tags={"Products"},
     *      summary="Add comment",
     *      description="Returns Product",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Add comment to product",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="forms",
     *                  type="object",
     *                  required={"name","email","text"},
     *                  @OA\Property(property="name", type="string", example="gergegve"),
     *                  @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *                  @OA\Property(property="text", type="string", example="gergegve"),
     *              ),
     *              @OA\Property(
     *                  property="lang",
     *                  type="object",
     *                  @OA\Property(property="lang", type="string", example="en"),
     *              )
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
     *                      property="product",
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                      @OA\Property(property="slug", type="string", maxLength=255, example="stiralnyj-poroshok-dlya-novorozhdennyh-2kg"),
     *                      @OA\Property(property="name", type="string", maxLength=255, example="Laundry detergent for newborns, 2kg"),
     *                      @OA\Property(property="code", type="integer", example="7425"),
     *                      @OA\Property(property="price", type="integer", example="250.00"),
     *                      @OA\Property(property="price_old", type="integer", example="150.00"),
     *                      @OA\Property(property="count_product", type="integer", example="6"),
     *                      @OA\Property(property="short_body", type="string", example="Washing powders"),
     *                      @OA\Property(property="body", type="string", example="Washing powders"),
     *                      @OA\Property(property="info", type="string", example="Washing powders"),
     *                      @OA\Property(property="shipping_payment", type="string", example="Washing powders"),
     *                      @OA\Property(property="meta_title", type="string", maxLength=255, example="Washing powders"),
     *                      @OA\Property(property="meta_keywords", type="string", maxLength=255, example="Washing powders"),
     *                      @OA\Property(property="meta_description", type="string", example="Washing powders"),
     *                      @OA\Property(
     *                          property="alike",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                              @OA\Property(property="slug", type="string", maxLength=255, example="stiralnyj-poroshok-dlya-novorozhdennyh-2kg"),
     *                              @OA\Property(property="name", type="string", maxLength=255, example="Laundry detergent for newborns, 2kg"),
     *                              @OA\Property(property="code", type="integer", example="7425"),
     *                              @OA\Property(property="price", type="integer", example="250.00"),
     *                              @OA\Property(property="price_old", type="integer", example="150.00"),
     *                              @OA\Property(property="count_product", type="integer", example="6"),
     *                              @OA\Property(property="short_body", type="string", example="Washing powders"),
     *                              @OA\Property(property="info_img", type="string", example="450 gr"),
     *                              @OA\Property(
     *                                  property="img",
     *                                  type="array",
     *                                  @OA\Items(
     *                                      type="object",
     *                                      @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                      @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                                      @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/products/1661446710_coollogo_com-14608366"),
     *                                      @OA\Property(property="image", type="string", maxLength=255, example="1661446710_coollogo_com-14608366"),
     *                                      @OA\Property(property="type_img", type="string", maxLength=255, example="jpg"),
     *                                      @OA\Property(property="product_id", type="integer", readOnly="true", example="1"),
     *                                      @OA\Property(property="main_img", type="integer", example="1"),
     *                                      @OA\Property(property="numeral", type="integer", example="1"),
     *                                  ),
     *                              ),
     *                              @OA\Property(
     *                                  property="comments",
     *                                  type="array",
     *                                  @OA\Items(
     *                                      type="object",
     *                                      @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                      @OA\Property(property="name", type="string", maxLength=255, example="Shurik"),
     *                                      @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
     *                                      @OA\Property(property="rating", type="integer", example="5"),
     *                                      @OA\Property(property="text", type="string", maxLength=255, example="Text"),
     *                                      @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                                      @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
     *                                  ),
     *                              ),
     *                          ),
     *                      ),
     *                      @OA\Property(
     *                         property="specification",
     *                         type="array",
     *                         @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="name", type="string", maxLength=255, example="the weight"),
     *                              @OA\Property(property="value", type="string", maxLength=255, example="2 kg"),
     *                         ),
     *                      ),
     *                      @OA\Property(
     *                         property="category",
     *                         type="array",
     *                         @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                              @OA\Property(property="name", type="string", maxLength=255, example="Washing powders"),
     *                              @OA\Property(property="slug", type="string", maxLength=255, example="stiralnye-poroshki"),
     *                         ),
     *                      ),
     *                      @OA\Property(
     *                         property="img",
     *                         type="array",
     *                         @OA\Items(
     *                            type="object",
     *                            @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                            @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                            @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/products/1661446710_coollogo_com-14608366"),
     *                            @OA\Property(property="image", type="string", maxLength=255, example="1661446710_coollogo_com-14608366"),
     *                            @OA\Property(property="type_img", type="string", maxLength=255, example="jpg"),
     *                            @OA\Property(property="product_id", type="integer", readOnly="true", example="1"),
     *                            @OA\Property(property="main_img", type="integer", example="1"),
     *                            @OA\Property(property="numeral", type="integer", example="1"),
     *                          ),
     *                       ),
     *                       @OA\Property(
     *                          property="comments",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                              @OA\Property(property="name", type="string", maxLength=255, example="Shurik"),
     *                              @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
     *                              @OA\Property(property="rating", type="integer", example="5"),
     *                              @OA\Property(property="text", type="string", maxLength=255, example="Text"),
     *                              @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                              @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
     *                          ),
     *                       ),
     *                    ),
     *                 ),
     *              )
     *          )
     *      ),
     * )
     */
    public function comment(CommentRequest $commentRequest, $id): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'product' => $this->productService->addComment(
                    $id,
                    $commentRequest
                )
            ]
        );
    }

}
