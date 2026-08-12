<?php
declare(strict_types=1);

namespace Survos\Api\Contracts\Dto;

/**
 * Deliberately small: one case per distinct situation an app currently handles,
 * not a general-purpose HTTP status catalog. Add a case when a call site needs
 * one, not speculatively.
 */
enum ApiErrorCode: string
{
    case InvalidParams = 'invalid_params';
    case NotFound = 'not_found';
    case InternalError = 'internal_error';

    public function httpStatus(): int
    {
        return match ($this) {
            self::InvalidParams => 400,
            self::NotFound => 404,
            self::InternalError => 500,
        };
    }
}
