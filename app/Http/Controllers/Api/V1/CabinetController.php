<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Services\Api\V1\CabinetService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    /**
     * CabinetController constructor.
     * @param CabinetService $cabinetService
     */
    public function __construct(private CabinetService $cabinetService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/cabinet/user/{id}",
     *      operationId="Cabinet",
     *      tags={"Cabinet"},
     *      summary="Get User",
     *      description="Returns Orders",
     *      security={ {"bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
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
     *                      property="orders",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="first_name", type="string", maxLength=255, example="John"),
     *                          @OA\Property(property="last_name", type="string", maxLength=255, example="Doe"),
     *                          @OA\Property(property="middle_name", type="string", maxLength=255, example="Doese"),
     *                          @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
     *                          @OA\Property(property="phone", type="string", maxLength=255, example="+380999999999"),
     *                          @OA\Property(property="region", type="string", maxLength=255, example="article"),
     *                          @OA\Property(property="total_cost", type="integer", example="72.00"),
     *                          @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
     *                          @OA\Property(
     *                              property="status_order",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                  @OA\Property(property="name", type="string", maxLength=255, example="Accepted orders"),
     *                                  @OA\Property(property="title", type="string", maxLength=255, example="Accepted order"),
     *                              ),
     *                          ),
     *                          @OA\Property(
     *                              property="api_user_order_products",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                  @OA\Property(property="name", type="string", maxLength=255, example="Accepted orders"),
     *                                  @OA\Property(property="name_title", type="string", maxLength=255, example="Accepted order"),
     *                              ),
     *                          ),
     *                      ),
     *                  ),
     *              )
     *          )
     *      ),
     * )
     */
    public function index(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'orders' => $this->cabinetService->getOrders(
                    $request->get('lang'),
                    $id
                )
            ]
        );
    }

    /**
     * @OA\Post(
     *      path="/api/cabinet/user",
     *      operationId="UserUpdate",
     *      tags={"Cabinet"},
     *      summary="Update user",
     *      description="Returns User",
     *      security={ {"bearerAuth": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Update user cabinet",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="form",
     *                  type="object",
     *                  required={"id","first_name","last_name","middle_name","email","phone"},
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="first_name", type="string", maxLength=255, example="John"),
     *                  @OA\Property(property="last_name", type="string", maxLength=255, example="Doe"),
     *                  @OA\Property(property="middle_name", type="string", maxLength=255, example="Doese"),
     *                  @OA\Property(property="email", type="string", format="email", description="User unique email address", example="user@gmail.com"),
     *                  @OA\Property(property="phone", type="string", maxLength=255, example="+380999999999")
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
     *                      property="user",
     *                      type="object",
     *                      @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function update(UpdateUserRequest $request): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'user' => $this->cabinetService->updateUser($request->get('form'))
            ]
        );
    }
}
