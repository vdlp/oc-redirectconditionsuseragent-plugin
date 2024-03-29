<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Tests;

use PluginTestCase;
use Vdlp\RedirectConditions\Models\ConditionParameter;
use Vdlp\RedirectConditions\Tests\Factories\RedirectRuleFactory;
use Vdlp\RedirectConditionsUserAgent\Classes\CrawlerCondition;
use Vdlp\RedirectConditionsUserAgent\Tests\Factories\UserAgentFactory;

class CrawlerConditionTest extends PluginTestCase
{
    public function testCrawler()
    {
        /** @var CrawlerCondition $condition */
        $condition = resolve(CrawlerCondition::class);

        ConditionParameter::create([
            'redirect_id' => 1,
            'condition_code' => $condition->getCode(),
            'is_enabled' => date('Y-m-d H:i:s'),
            'parameters' => [
                'crawler_only' => [
                    '1',
                ]
            ]
        ]);

        $rule = RedirectRuleFactory::testCreateRedirectRule();

        $condition->setUserAgent(UserAgentFactory::getCrawler());
        self::assertTrue($condition->passes($rule, '/from/url'));

        $condition->setUserAgent(UserAgentFactory::getDesktop());
        self::assertFalse($condition->passes($rule, '/from/url'));
    }
}
