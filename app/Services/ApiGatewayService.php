<?php

namespace App\Services;

use App\Dtos\RouteDto;
use App\Filters\Filter;
use Illuminate\Http\Request;
use App\Services\MatcherRouteService;

class ApiGatewayService
{

  protected $config_routes;

  public function __construct(
    private MatcherRouteService $matcherRoute,
    private ForwardRequestService $forwardRequest,
    private Filter $filter
  )
  {
      $this->config_routes =  collect(config('apigateway.routes'))
                             ->map(fn ($routeData) => (new RouteDto())->fromArray($routeData) );             
  }


  /**
   * Handles an incoming request by matching it to a defined route and forwarding it accordingly.
   *
   * This method uses the RouteMatcher to find a matching RouteDto based on the 
   * request path and HTTP method. If a matching route is found, the request 
   * is forwarded to the specified service URL. If no matching route is found, 
   * a 404 JSON response is returned with an error message.
   *
   * @param \Illuminate\Http\Request $request The incoming HTTP request object.
   *
   * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response The response from the forwarded request or a 404 error response.
   */
    public function handleRequest(Request $request)
    { 
        $route = $this->matcherRoute->match($this->config_routes->toArray(), $request->path(), $request->getMethod());
        if (!$route) {
            return response()->json(['error' => 'Route not found'], 404);
        }

        if ($route->filters && count($route->filters) > 0){
          $request = $this->filter
                            ->addFilters($route->filters)
                            ->apply($request);
        }

        return $this->forwardRequest->forward($request, $route);
    }

}
