<?php
namespace App\Enums;

enum AuthTypeEnum: string {

    case None = 'none';
    case Custom = "custom";
    case Bearer = 'bearer';
    case ApiKey = 'api_key_custom';

    public function isNone(): bool {
      return $this === self::None;
    }

    public function isBearer(): bool {
      return $this === self::Bearer;
    }

    public function isApiKey(): bool {
        return $this === self::ApiKey;
    }

    public function isAuthCustom(): bool {
      return $this === self::Custom;
  }
}