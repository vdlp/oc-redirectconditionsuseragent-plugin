<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Traits;

/**
 * Class UserAgent
 *
 * @package Vdlp\RedirectConditionsUserAgent\Traits
 */
trait UserAgent
{
    /**
     * @var string|null
     */
    protected $userAgent;

    /**
     * @param string $userAgent
     * @return void
     */
    public function setUserAgent(string $userAgent)
    {
        $this->userAgent = $userAgent;
    }
}
