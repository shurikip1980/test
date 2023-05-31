<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ResponseService;
use App\Http\Services\Api\V1\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * SliderController constructor.
     * @param SliderService $sliderService
     */
    public function __construct(private SliderService $sliderService)
    {
    }

    /**
     * @OA\Get(
     *      path="/api/sliders",
     *      operationId="Sliders",
     *      tags={"Sliders"},
     *      summary="Get list of sliders",
     *      description="Returns list of sliders",
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
     *                      property="sliders",
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                          @OA\Property(property="name", type="string", maxLength=255, example="clean"),
     *                          @OA\Property(property="title", type="string", maxLength=255, example="Perfect it's clean"),
     *                          @OA\Property(property="short_body", type="string", maxLength=255, example="Choose what's best"),
     *                          @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/sliders/1661953758_2.jpg"),
     *                          @OA\Property(property="link", type="string", maxLength=255, example="https://www.youtube.com/"),
     *                      ),
     *                  ),
     *              )
     *          )
     *      ),
     * )
     */
    public function index(Request $request)
    {
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'sliders' => $this->sliderService->getSliders($request->get('lang'))
            ]
        );
    }

}
