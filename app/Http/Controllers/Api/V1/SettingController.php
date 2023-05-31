<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ResponseService;
use App\Http\Services\Api\V1\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * SettingController constructor.
     * @param SettingService $settingService
     */
    public function __construct(private SettingService $settingService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/settings",
     *      operationId="Settings",
     *      tags={"Settings"},
     *      summary="Get settings",
     *      description="Returns settings",
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
     *                      property="settings",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="Article"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
     *                          @OA\Property(property="link", type="string", maxLength=255, example="https://www.youtube.com/"),
     *                          @OA\Property(property="time", type="integer", example="5"),
     *                          @OA\Property(property="map", type="string", maxLength=255, example="https://www.google.com/maps/place/Kropyvnytskyi+Tsentr+Reabilitatsiyi+Slukhu/@48.49463,32.2333777,13z/data=!4m5!3m4!1s0x40d0431400ceba33:0x4c3c1000c8e611e0!8m2!3d48.5022259!4d32.2347259"),
     *                          @OA\Property(property="email", type="string", maxLength=255, example="admin@gmail.com"),
     *                          @OA\Property(property="address", type="string", maxLength=255, example="Kyiv, Lesi Ukrainky street 12,"),
     *                          @OA\Property(property="site_name", type="string", maxLength=255, example="Test"),
     *                          @OA\Property(property="work", type="string", maxLength=255, example="Test"),
     *                          @OA\Property(
     *                              property="phones",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                                  @OA\Property(property="phone", type="string", maxLength=255, example="+38(099)999-99-99"),
     *                              ),
     *                          ),
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
                'settings' => $this->settingService->getSettings($request->get('lang'))
            ]
        );
    }

}
