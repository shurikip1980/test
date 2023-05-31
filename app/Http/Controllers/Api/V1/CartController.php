<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CartPostRequest;
use App\Http\Services\Api\V1\CartService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(private CartService $cartService)
    {
    }

    /**
     * @OA\Post(
     *      path="/api/cart",
     *      operationId="Cart",
     *      tags={"Cart"},
     *      summary="Get orders product",
     *      description="Returns orders product",
     *      @OA\RequestBody(
     *          required=true,
     *          description="orders product id, num",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                      property="productsId",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", example="2"),
     *                          @OA\Property(property="num", type="integer", example="4"),
     *                      )
     *                  )
     *              ),
     *              @OA\Property(property="lang", type="string", example="en"),
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
     *                      @OA\Property(
     *                          property="products",
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
     *                                  )
     *                              ),
     *                              @OA\Property(property="num", type="integer", example="2"),
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     * )
     * */
    public function index(Request $request)
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'products' => $this->cartService->getCartProducts(
                    $request->get('data')['productsId'],
                    $request->get('lang')
                )
            ]
        );
    }

    /**
     * @OA\Post(
     *      path="/api/cart/add",
     *      operationId="CartAdd",
     *      tags={"Cart"},
     *      summary="Add orders product",
     *      description="Returns true",
     *      @OA\RequestBody(
     *          required=true,
     *          description="orders product",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="form",
     *                  type="object",
     *                  @OA\Property(property="first_name", type="string", maxLength=255, example="John"),
     *                  @OA\Property(property="last_name", type="string", maxLength=255, example="Doe"),
     *                  @OA\Property(property="middle_name", type="string", maxLength=255, example="Doese"),
     *                  @OA\Property(property="phone", type="string", maxLength=255, example="+380999999999"),
     *                  @OA\Property(property="email", type="string", format="email", example="user@gmail.com"),
     *                  @OA\Property(property="region", type="string", example="en"),
     *                  @OA\Property(property="city", type="string", example="en"),
     *                  @OA\Property(property="department", type="string", example="en"),
     *                  @OA\Property(property="address", type="string", example="en"),
     *                  @OA\Property(property="comment", type="string", example="en"),
     *                  @OA\Property(property="delivery", type="integer", example="2"),
     *                  @OA\Property(property="payment", type="integer", example="1"),
     *              ),
     *              @OA\Property(
     *                  property="products",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                       @OA\Property(property="id", type="integer", example="2"),
     *                       @OA\Property(property="num", type="integer", example="4"),
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="user",
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example="15"),
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
     *                  @OA\Property(property="products", type="boolean", example="true"),
     *               )
     *           )
     *       )
     * )
     * */
    public function addOrder(CartPostRequest $request)
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'order' => $this->cartService->addOrder($request)
            ]
        );
    }

}
