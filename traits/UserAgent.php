<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Traits;

trait UserAgent
{
    protected ?string $userAgent;

    public function setUserAgent(?string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }
}
