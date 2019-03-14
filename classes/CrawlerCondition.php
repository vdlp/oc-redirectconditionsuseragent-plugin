<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Classes;

use Illuminate\Http\Request;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Vdlp\Redirect\Classes\RedirectRule;
use Vdlp\RedirectConditions\Classes\Condition;
use Vdlp\RedirectConditionsUserAgent\Traits\UserAgent;

/**
 * Class CrawlerCondition
 *
 * @package Vdlp\RedirectConditionsUserAgent\Classes
 */
class CrawlerCondition extends Condition
{
    use UserAgent;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return 'vdlp_crawler';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): string
    {
        return 'Crawler';
    }

    /**
     * {@inheritdoc}
     */
    public function getExplanation(): string
    {
        return 'A crawler is a program that systematically browses the World Wide Web in order to create an index of data. This condition allows you to redirect when a crawler is detected.';
    }

    /**
     * {@inheritdoc}
     */
    public function passes(RedirectRule $rule, string $requestUri): bool
    {
        $properties = $this->getParameters($rule->getId());

        if (empty($properties)) {
            return true;
        }

        $crawlerOnly = (bool) ($properties['crawler_only'] ?? false);

        return $crawlerOnly && (new CrawlerDetect(null, $this->userAgent ?? $this->request->user()))->isCrawler();
    }

    /**
     * {@inheritdoc}
     */
    public function getFormConfig(): array
    {
        return [
            'crawler_only' => [
                'tab' => self::TAB_NAME,
                'label' => 'Match crawlers only',
                'type' => 'checkbox',
                'span' => 'left',
            ]
        ];
    }
}