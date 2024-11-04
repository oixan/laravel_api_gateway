<?php

namespace App\Services;

use App\Dtos\RouteDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\PathUrlSimpleGeneratorService;

class ForwardRequestService{

  public function  __construct(
    protected PathUrlSimpleGeneratorService $pathUrlSimpleGenerator,
    protected HeaderRequestService $headerRequest
  ){

  }

  /**
   * Forwards the incoming request to an external URL based on the given route.
   *
   * Generates the target URL, retrieves headers, and sends the request with 
   * the specified HTTP method, query parameters, and JSON body. Returns the 
   * response from the external service.
   *
   * @param Request $request The incoming request to be forwarded.
   * @param RouteDto $route The route data containing routing and authentication info.
   * @return \Illuminate\Http\Response The response from the forwarded request.
   */
  public function forward(Request $request, RouteDto $route)
  {
    $url = $this->pathUrlSimpleGenerator->generate($route, $request->path());

    $timeout = $route->timeout ?? 5000;

    $headers = $this->headerRequest->get($request, $route);

    $response = Http::withHeaders($headers)
                    ->timeout($timeout)
                    ->send( $route->method, $url, [
                        'query' => $request->query(),
                        'json' => $request->all(),
                    ]);

    return response($response->body(), $response->status());
  }
}