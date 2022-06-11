<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Tests;

use PluginTestCase;
use Vdlp\RedirectConditions\Models\ConditionParameter;
use Vdlp\RedirectConditions\Tests\Factories\RedirectRuleFactory;
use Vdlp\RedirectConditionsUserAgent\Classes\DeviceCondition;
use Vdlp\RedirectConditionsUserAgent\Tests\Factories\UserAgentFactory;

class DeviceConditionTest extends PluginTestCase
{
    public function testTablet()
    {
        ConditionParameter::create([
            'redirect_id' => 1,
            'condition_code' => 'vdlp_device',
            'is_enabled' => date('Y-m-d H:i:s'),
            'parameters' => [
                'allowed_devices' => [
                    'tablet',
                ]
            ]
        ]);

        $rule = RedirectRuleFactory::testCreateRedirectRule();

        /** @var DeviceCondition $condition */
        $condition = resolve(DeviceCondition::class);
        $condition->setUserAgent(UserAgentFactory::getTablet());

        self::assertTrue($condition->passes($rule, '/from/url'));

        $condition->setUserAgent(UserAgentFactory::getSmartPhone());
        self::assertFalse($condition->passes($rule, '/from/url'));

        $condition->setUserAgent(UserAgentFactory::getDesktop());
        self::assertFalse($condition->passes($rule, '/from/url'));
    }

    public function testDesktop()
    {
        ConditionParameter::create([
            'redirect_id' => 1,
            'condition_code' => 'vdlp_device',
            'is_enabled' => date('Y-m-d H:i:s'),
            'parameters' => [
                'allowed_devices' => [
                    'desktop'
                ]
            ]
        ]);

        $rule = RedirectRuleFactory::testCreateRedirectRule();

        /** @var DeviceCondition $condition */
        $condition = resolve(DeviceCondition::class);

        $condition->setUserAgent(UserAgentFactory::getTablet());
        self::assertFalse($condition->passes($rule, '/from/url'));

        $condition->setUserAgent(UserAgentFactory::getSmartPhone());
        self::assertFalse($condition->passes($rule, '/from/url'));

        $condition->setUserAgent(UserAgentFactory::getDesktop());
        self::assertTrue($condition->passes($rule, '/from/url'));
    }

    public function testSmartPhone()
    {
        ConditionParameter::create([
            'redirect_id' => 1,
            'condition_code' => 'vdlp_device',
            'is_enabled' => date('Y-m-d H:i:s'),
            'parameters' => [
                'allowed_devices' => [
                    'smartphone'
                ]
            ]
        ]);

        $rule = RedirectRuleFactory::testCreateRedirectRule();

        /** @var DeviceCondition $condition */
        $condition = resolve(DeviceCondition::class);

        $condition->setUserAgent(UserAgentFactory::getTablet());
        self::assertFalse($condition->passes($rule, '/from/url'));

        $condition->setUserAgent(UserAgentFactory::getSmartPhone());
        self::assertTrue($condition->passes($rule, '/from/url'));

        $condition->setUserAgent(UserAgentFactory::getDesktop());
        self::assertFalse($condition->passes($rule, '/from/url'));
    }
}
