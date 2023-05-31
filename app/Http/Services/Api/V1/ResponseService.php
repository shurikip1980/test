<?php

namespace App\Http\Services\Api\V1;

use Illuminate\Http\Response;

class ResponseService
{
    /**
     * @param $status
     * @param array $errors
     * @param array $data
     * @return array
     */
    private static function responsePrams($status, $errors = [], $data = [])
    {
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data,
        ];
    }

    /**
     * @param $status
     * @param int $code
     * @param array $errors
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendJsonResponse($status, $code = 200, $errors = [], $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            self::responsePrams($status, $errors, $data),
            $code
        );
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = []): \Illuminate\Http\JsonResponse
    {
        return self::sendJsonResponse(true, 200, [], $data);
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function notFound($data = []): \Illuminate\Http\JsonResponse
    {
        return self::sendJsonResponse(false, 404, [], []);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function notAuthorize(): \Illuminate\Http\JsonResponse
    {
        return self::sendJsonResponse(false, 401, [],[]);
    }
}
