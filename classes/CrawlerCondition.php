<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Classes;

use Illuminate\Http\Request;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Vdlp\Redirect\Classes\RedirectRule;
use Vdlp\RedirectConditions\Classes\Condition;
use Vdlp\RedirectConditionsUserAgent\Traits\UserAgent;

class CrawlerCondition extends Condition
{
    use UserAgent;

    public function __construct(
        private Request $request,
    ) {
    }

    public function getCode(): string
    {
        return 'vdlp_crawler';
    }

    public function getDescription(): string
    {
        return 'vdlp.redirectconditionsuseragent::lang.crawler.description';
    }

    public function getExplanation(): string
    {
        return 'vdlp.redirectconditionsuseragent::lang.crawler.explanation';
    }

    public function passes(RedirectRule $rule, string $requestUri): bool
    {
        $properties = $this->getParameters($rule->getId());

        if (empty($properties)) {
            return true;
        }

        $crawlerOnly = (bool) ($properties['crawler_only'] ?? false);

        return $crawlerOnly && (new CrawlerDetect(null, $this->userAgent ?? $this->request->user()))->isCrawler();
    }

    public function getFormConfig(): array
    {
        return [
            'crawler_only' => [
                'tab' => self::TAB_NAME,
                'label' => 'vdlp.redirectconditionsuseragent::lang.crawler.label',
                'type' => 'checkbox',
                'span' => 'left',
            ],
        ];
    }
}
