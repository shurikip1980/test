<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Services\Api\V1\PaymentService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class PaymentController
{
    /**
     * PaymentController constructor.
     * @param PaymentService $paymentService
     */
    public function __construct(private PaymentService $paymentService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/payments",
     *      operationId="Payments",
     *      tags={"Payments"},
     *      summary="Get list of payments",
     *      description="Returns list of payments",
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
     *                      property="payments",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Nova Poshta"),
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
                'payments' => $this->paymentService->getPayments($request->get('lang'))
            ]
        );
    }
}
