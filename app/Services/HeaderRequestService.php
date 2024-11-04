<?php

namespace App\Services;

use App\Dtos\RouteDto;
use App\Enums\AuthTypeEnum;
use Illuminate\Http\Request;

class HeaderRequestService {

  public function __construct() {

  }


  /**
   * Retrieves and processes the headers from the incoming request.
   *
   * @param Request $request The incoming request containing headers.
   * @param RouteDto $route The route data transfer object containing authentication information.
   * @return array The processed array of headers after clearing and adding the API key if applicable.
   */
  public function get(Request $request, RouteDto $route): array{

    $headers = $request->headers->all();

    $headers = $this->clearHeaders($headers);
    $headers = $this->addHeadersAuthApiKey($headers, $route);
    
    return $headers;
  }


  /**
   * Clears specific unnecessary headers from the given headers array.
   *
   * @param array $headers The array of headers to clean.
   * @return array The cleaned array of headers.
   */
  private function clearHeaders(array $headers){
    unset($headers['postman-token']); 
    unset($headers['host']);

    return $headers;
  }


  /**
   * Adds an API key to the headers if the specified route requires API key authentication.
   *
   * @param array $headers The array of headers to modify.
   * @param RouteDto $route The route data transfer object containing authentication info.
   * @return array The updated headers array with the API key added if applicable.
   */
  private function addHeadersAuthApiKey(array $headers, RouteDto $route){
    if ( isset($route->auth) 
      && $route->auth === AuthTypeEnum::None->isApiKey()
    ) {
      $headers[$route->api_key_header] = $route->api_key_value;
    }

    return $headers;
  }

}
