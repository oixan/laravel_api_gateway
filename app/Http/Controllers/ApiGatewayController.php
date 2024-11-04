<?php
namespace App\Http\Controllers;

use App\Services\ApiGatewayService;
use Illuminate\Http\Request;

class ApiGatewayController extends Controller
{
    public function __construct(
      protected ApiGatewayService $apiGateway
    )
    {
      
    }

    public function handle(Request $request, $endpoint)
    {   
        return $this->apiGateway->handleRequest($request);
    }

}
