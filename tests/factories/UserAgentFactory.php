<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Tests\Factories;

class UserAgentFactory
{
    public static function getSmartPhone(): string
    {
        return 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_1_2 like Mac OS X) '
            . 'AppleWebKit/604.3.5 (KHTML, like Gecko) Mobile/15B202';
    }

    public static function getTablet(): string
    {
        return 'Mozilla/5.0 (iPad; CPU OS 11_4_1 like Mac OS X) '
            . 'AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1';
    }

    public static function getDesktop(): string
    {
        return 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_2) '
            . 'AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36';
    }

    public static function getCrawler(): string
    {
        return 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';
    }
}
