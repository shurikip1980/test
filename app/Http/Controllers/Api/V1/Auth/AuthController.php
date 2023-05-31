<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Services\Api\V1\ResponseService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      operationId="authLogin",
     *      tags={"Auth"},
     *      summary="User Login",
     *      description="Login User Here",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
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
     *                  @OA\Property(property="api_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9."),
     *                  @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *                  @OA\Property(property="token_type", type="string", example="Bearer"),
     *                  @OA\Property(property="expires_at", type="string", example="2023-11-06 02:45:36"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Wrong credentials response",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example="false"),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="message",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="These credentials do not match our records.",
     *                      ),
     *                  ),
     *              ),
     *              @OA\Property(property="data", type="object"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example="false"),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The email field is required.",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The password field is required.",
     *                      ),
     *                  ),
     *              ),
     *              @OA\Property(property="data", type="object"),
     *          )
     *      )
     * )
     */
    public function login(LoginRequest $loginRequest): \Illuminate\Http\JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return ResponseService::sendJsonResponse(
                false,
                403,
                ['message' => [__('auth.failed')]]
            );
        }

        $user = $loginRequest->user();
        $tokenResult = $user->createToken('Personal Access Token');

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'api_token' => $tokenResult->accessToken,
                'user' => $user,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            ]
        );
    }

    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      operationId="Register",
     *      tags={"Auth"},
     *      summary="User Register",
     *      description="User Register here",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *              required={"first_name","last_name","middle_name","phone","email","email","password"},
     *              @OA\Property(property="first_name", type="string", maxLength=255, example="John"),
     *              @OA\Property(property="last_name", type="string", maxLength=255, example="Doe"),
     *              @OA\Property(property="middle_name", type="string", maxLength=255, example="Doese"),
     *              @OA\Property(property="phone", type="string", maxLength=255, example="+380999999999"),
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *              @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
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
     *                  @OA\Property(property="api_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9."),
     *                  @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *                  @OA\Property(property="token_type", type="string", example="Bearer"),
     *                  @OA\Property(property="expires_at", type="string", example="2023-11-06 02:45:36"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example="false"),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="first_name",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The first name field is required.",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="last_name",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The last name field is required.",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="middle_name",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The middle name field is required.",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="phone",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The phone field is required.",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The email field is required.",
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The password field is required.",
     *                      ),
     *                  ),
     *              ),
     *              @OA\Property(property="data", type="object"),
     *          )
     *      )
     * )
     */
    public function register(RegisterRequest $registerRequest): \Illuminate\Http\JsonResponse
    {
        $user = User::create([
            'first_name' => $registerRequest->get('first_name'),
            'last_name' => $registerRequest->get('last_name'),
            'middle_name' => $registerRequest->get('middle_name'),
            'phone' => $registerRequest->get('phone'),
            'email' => $registerRequest->get('email'),
            'password' => Hash::make($registerRequest->get('password')),
            'activated' => 1,
        ]);

        $user->assignRole('user');
        $tokenResult = $user->createToken('Personal Access Token');

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'api_token' => $tokenResult->accessToken,
                'user' => $user,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            ]
        );
    }
}
