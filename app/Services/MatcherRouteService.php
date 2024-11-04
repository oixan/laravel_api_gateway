<?php

namespace App\Services;

use App\Dtos\RouteDto;

class MatcherRouteService{

  public function  __construct(){

  }


  /**
   * Matches the request path and method with a route from the provided array of RouteDto.
   *
   * @param RouteDto[] $routes An array of RouteDto objects to match against.
   * @param string $requestPath The incoming request path.
   * @param string $requestMethod The incoming request method.
   *
   * @return RouteDto|null The matched RouteDto object, or null if no match is found.
   */
  public function match(array $routes, string $requestPath, string $requestMethod): ?RouteDto
  {
        foreach ($routes as $route) {
            // Check if the prefix matches the start of the request path
            $prefix = '/' . trim($route->prefix, '/');
            $requestPath = '/' . ltrim( $requestPath, 'api/');

            if (str_starts_with($requestPath, $prefix) && $requestMethod === $route->method) {
                return $route;
            }
        }

        // Return null if no matching route is found
        return null; 
  }


}