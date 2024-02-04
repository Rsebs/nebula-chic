<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreImageRequest extends FormRequest
{
  use ApiResponse;

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'file' => 'required|image|max:2048',
      'product_id' => 'required|exists:products,id',
    ];
  }

  /**
   * Handle a failed validation attempt.
   *
   * @param \Illuminate\Contracts\Validation\Validator $validator
   *
   * @return void
   *
   * @throws \Illuminate\Http\Exceptions\HttpResponseException
   */
  public function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(
      $this->errorResponse($validator->errors(), 'Validation error.', 422)
    );
  }
}
