<?php
declare(strict_types=1);

namespace Survos\Api\Contracts\Dto;

/**
 * One error shape for every hand-rolled JSON endpoint across Survos apps,
 * instead of each controller inventing its own. $message is safe to show a
 * caller; $detail is for extra, still-safe-to-expose context (which field
 * was invalid, which id was missing) - never a stack trace or internal state.
 *
 * Wire shape: {"error": {"code": "not_found", "message": "..."}}
 */
final class ApiError implements \JsonSerializable
{
    public function __construct(
        public readonly ApiErrorCode $code,
        public readonly string $message,
        public readonly ?string $detail = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $error = [
            'code' => $this->code->value,
            'message' => $this->message,
        ];
        if ($this->detail !== null) {
            $error['detail'] = $this->detail;
        }

        return ['error' => $error];
    }
}
