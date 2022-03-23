<?php

namespace App\Http\Requests;

use App\Http\Traits\HelperTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCampaignRequest extends FormRequest
{
    use HelperTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            "name" => "required|string|unique:campaigns",
            "from_date" => "required|date_format:Y-m-d",
            "to_date" => "required|date_format:Y-m-d",
            "total_budget" => "required|numeric",
            "daily_budget" => "required|numeric",
            "creative_upload" => "required|array",
            "creative_upload.*" => "mimes:jpg,jpeg,png"
        ];
    }

    /**
     * Custom Messages For Validation Errors
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'creative_upload.*.required' => 'Please upload an image',
            'creative_upload.*.mimes' => 'Only jpg, jpeg and png images are allowed.'
        ];
    }

    /**
     * Handle Validation Failed Request Response
     *
     * @param  mixed $validator
     * @return JsonResponse
     */
    protected function failedValidation(Validator $validator) : JsonResponse
    {
        throw new HttpResponseException($this->validationErrorsResponseHandler($validator->errors()->toArray()), 400);
    }
}