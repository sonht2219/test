<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class JsonResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);
        $data = $response->original;
        if (!in_array($response->getStatusCode(), [200, 201]))
            return $response;
        if (!$response instanceof JsonResponse) {
            return $this->jsonResponse($response->content(), $response->getStatusCode());
        }
        if (is_array($data) || $data instanceof Collection || $data instanceof Model || is_object($data)) {
            if ($data instanceof Model || $data instanceof Collection || is_object($data))
                return $this->jsonResponse($data, $response->getStatusCode());
            if (array_key_exists('status', $data) && array_key_exists('message', $data))
                return response()->json($data, $response->getStatusCode());
            if (array_key_exists('meta', $data))
                return $this->jsonResponse($data['data'], $response->getStatusCode(), $data['meta']);

            return $this->jsonResponse($data, $response->getStatusCode());
        }
        return $response;
    }

    public function jsonResponse($data, $status, $meta = null, $message = null) {
        $response_data = [
            "status" => 1,
            "message" => $message ?: __('messages.success'),
            "data" => $data
        ];

        if ($meta)
            $response_data['meta'] = $meta;

        return response()->json($response_data, $status);
    }
}
