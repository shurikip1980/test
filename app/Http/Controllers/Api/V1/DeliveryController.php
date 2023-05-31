<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Services\Api\V1\DeliveryService;
use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Http\Request;

class DeliveryController
{
    /**
     * DeliveryController constructor.
     * @param DeliveryService $deliveryService
     */
    public function __construct(private DeliveryService $deliveryService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/deliveries",
     *      operationId="Deliveries",
     *      tags={"Deliveries"},
     *      summary="Get list of deliveries",
     *      description="Returns list of deliveries",
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
     *                      property="deliveries",
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
                'deliveries' => $this->deliveryService->getDeliveries($request->get('lang'))
            ]
        );
    }
}
