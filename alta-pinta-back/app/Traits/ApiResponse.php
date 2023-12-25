<?php

namespace App\Traits;

trait ApiResponse
{
  /**
   * Generates a JSON response for a successful operation.
   * 
   * @param mixed $data
   * @param string $message
   * @param int $status
   * 
   * @return \Illuminate\Http\JsonResponse
   */
  protected function successResponse($data, $paginate = null, $message = "Success!", $status = 200)
  {
    return response()->json([
      "message" => $message,
      "statusCode" => $status,
      "data" => $data,
      "paginate" => $paginate,
    ], $status);
  }

  /**
   * Generate a JSON response for error scenarios.
   * 
   * @param mixed $data
   * @param string $message
   * @param int $status
   * 
   * @return \Illuminate\Http\JsonResponse
   */
  protected function errorResponse($error = [], $message = "Error.", $status = 500)
  {
    return response()->json([
      "message" => $message,
      "statusCode" => $status,
      "errors" => $error,
    ], $status);
  }
}
