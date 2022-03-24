<?php

namespace App\Http\Traits;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Upload Multiple Images To Specified Directory
     *
     * @param  array $images
     * @param  string $directory
     * @return array
     */
    protected function storeImage(array $images = [], string $directory = '/'): array
    {
        $uploadedImages = [];
        foreach ($images as $index => $value) {
            $name = uniqid() . '_' . $value->getClientOriginalName();
            Storage::put('public/'. $directory. '/' . $name, $value->getContent());
            $uploadedImages[$index] = [
                'file_name' => $name,
                'path' => Storage::url($directory. '/' . $name)
            ];
        }
        return $uploadedImages;
    }

    /**
     * Delete images from storage
     *
     * @param  array $images
     * @return void
     */
    private function deleteImage(array $images = [] , string $directory = '/'): void
    {
        foreach ($images as $image) {
            Storage::delete('public/'. $directory . '/' . $image['file_name']);
        }
    }
}