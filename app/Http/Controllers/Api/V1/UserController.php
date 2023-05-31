<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ResponseService;
use App\Http\Services\Api\V1\UserService;

class UserController extends Controller
{
    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(private UserService $userService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/user",
     *      operationId="User",
     *      tags={"User"},
     *      summary="Get User",
     *      description="Returns User",
     *      security={ {"bearerAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example="true"),
     *              @OA\Property(property="errors", type="object"),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Wrong credentials response",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example="false"),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="scalar",
     *                      type="string",
     *                      example="Unauthenticated.",
     *                  ),
     *              ),
     *              @OA\Property(property="data", type="object"),
     *          )
     *      )
     * )
     */
    public function show(): \Illuminate\Http\JsonResponse
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'user' => $this->userService->authUser()
            ]
        );
    }

}
