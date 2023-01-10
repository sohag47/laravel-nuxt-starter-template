<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiController extends Controller
{

    protected $statusCode = 200;

    const CODE_WRONG_ARGS = 'CWA';
    const CODE_NOT_FOUND = 'CNF';
    const CODE_INTERNAL_ERROR = 'CIE';
    const CODE_UNAUTHORIZED = 'CU';
    const CODE_FORBIDDEN = 'CF';
    const E_USER_WARNING = 'EU';

    /**
     * @param Manager $fractal
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $item
     * @param $callback
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithItem($item, $resourceClass)
    {

        return $this->respondWithArray(['data' => new $resourceClass($item)]);
    }

    /**
     * @param $collection
     * @param $callback
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithCollection($collection, $resourceClass)
    {
        return $this->respondWithArray(new $resourceClass($collection));
    }
    /**
     * @param $collection
     * @param $callback
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithPaginationCollection($collection, $resourceClass, $headers = [])
    {
        return $resourceClass::collection($collection)
            ->response()
            ->setStatusCode($this->statusCode)
            ->withHeaders($headers);
    }

    /**
     * @param array $array
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithArray($resource, array $headers = [])
    {

        return response()->json($resource, $this->statusCode, $headers);
    }

    /**
     * @param $message
     * @param $errorCode
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }

        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)
            ->respondWithError($message, self::CODE_FORBIDDEN);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)
            ->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
            ->respondWithError($message, self::CODE_NOT_FOUND);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
            ->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)
            ->respondWithError($message, self::CODE_WRONG_ARGS);
    }

    public function respondWithBoolean()
    {
    }
}
