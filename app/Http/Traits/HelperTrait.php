<?php

namespace App\Http\Traits;
use Illuminate\Http\JsonResponse;

trait HelperTrait {

    /**
     * Json Formatted Success Response
     *
     * @param  array $data
     * @param  string $message
     * @return JsonResponse
     */
    protected function successResponseHandler(array $data = [],string $message = null) : JsonResponse
    {
        return response()->json([
            'status'    =>  "success",
            'data'      =>  $data,
            'message'   =>  $message
        ], 200);
    }

    /**
     * Json Formatted Success Response
     *
     * @param  array $errors
     * @return JsonResponse
     */
    protected function validationErrorsResponseHandler(array $errors = []) : JsonResponse
    {
        return response()->json([
            'status'    =>  "fail",
            'errors'    =>  $errors,
            'message'   =>  "Invalid Parameter(s)"
        ], 400);
    }


    /**
     * Json Formatted Custom Error Response
     *
     * @param  mixed $message
     * @param  mixed $statusCode
     * @return JsonResponse
     */
    protected function customErrorResponse(string $message = null,int $statusCode = 400) : JsonResponse
    {
        return response()->json([
            'status'    =>  "fail",
            'errors'    =>  [],
            'message'   =>  $message
        ], $statusCode);
    }
}