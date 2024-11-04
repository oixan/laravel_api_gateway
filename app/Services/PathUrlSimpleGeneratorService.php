<?php

namespace App\Services;

use App\Dtos\RouteDto;

class PathUrlSimpleGeneratorService {

  public function __construct() {

  }


  /**
   * Generates the full service URL by appending the relevant path segment 
   * from the incoming request to the base service URL.
   *
   * @param RouteDto $route The route configuration object containing the prefix and service URL.
   * @param string $requestPath The path of the incoming request.
   *
   * @return string The full URL to which the request should be forwarded.
   */
  public function generate(RouteDto $route, string $requestPath): string{

    $prefix = trim($route->prefix, '/');

    $remainingPath = preg_replace("#^api/#", '', $requestPath);
    $remainingPath = preg_replace("#^$prefix#", '', $remainingPath);
    
    $remainingPath = ltrim($remainingPath, '/');

    return rtrim($route->service_url, '/') . '/' . $remainingPath;
  }

}
