<?php

namespace App\Dtos;

class RouteDto{

  public function __construct(
    public string|null $prefix = null,
    public string|null $method = null,
    public string|null $service_url = null,
    public int $timeout = 5000,
    public string|null $auth = null,
    public string|null $api_key_header = null,
    public string|null $api_key_value = null,
  )
  {
    
  }

  public function fromArray(array $data): self{
    return new self(
      $data['prefix'] ?? null,
      $data['method'] ?? null,
      $data['service_url'] ?? null,
      $data['timeout'] ?? 5000,
      $data['auth'] ?? null,
      $data['api_key_header'] ?? null,
      $data['api_key_value'] ?? null,
    );
  }

}