<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Tests;

use Faker\Provider\UserAgent;
use PluginTestCase;
use Vdlp\RedirectConditions\Models\ConditionParameter;
use Vdlp\RedirectConditions\Tests\Factories\RedirectRuleFactory;
use Vdlp\RedirectConditionsUserAgent\Classes\OperationSystemCondition;

/**
 * Class OperationSystemConditionTest
 *
 * @package Vdlp\RedirectConditionsUserAgent\Tests
 */
class OperationSystemConditionTest extends PluginTestCase
{
    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     */
    public function testMac()
    {
        ConditionParameter::create([
            'redirect_id' => 1,
            'condition_code' => 'vdlp_os',
            'is_enabled' => date('Y-m-d H:i:s'),
            'parameters' => [
                'allowed_os_families' => [
                    'Mac',
                ]
            ]
        ]);

        $rule = RedirectRuleFactory::createRedirectRule();

        $userAgent = UserAgent::macPlatformToken();

        /** @var OperationSystemCondition $condition */
        $condition = resolve(OperationSystemCondition::class);
        $condition->setUserAgent($userAgent);

        self::assertTrue($condition->passes($rule, '/from/url'));

        self::assertTrue(
            $condition->passes($rule, '/from/url'),
            $userAgent . ' does not matches the Mac family.'
        );
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     */
    public function testWindows()
    {
        ConditionParameter::create([
            'redirect_id' => 1,
            'condition_code' => 'vdlp_os',
            'parameters' => [
                'allowed_os_families' => [
                    'Windows',
                    'Windows Mobile'
                ]
            ]
        ]);

        $rule = RedirectRuleFactory::createRedirectRule();

        $userAgent = UserAgent::windowsPlatformToken();

        /** @var OperationSystemCondition $condition */
        $condition = resolve(OperationSystemCondition::class);
        $condition->setUserAgent($userAgent);

        self::assertTrue(
            $condition->passes($rule, '/from/url'),
            $userAgent . ' does not matches the Windows family.'
        );
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     */
    public function testLinux()
    {
        ConditionParameter::create([
            'redirect_id' => 1,
            'condition_code' => 'vdlp_os',
            'parameters' => [
                'allowed_os_families' => [
                    'GNU/Linux',
                ]
            ]
        ]);

        $rule = RedirectRuleFactory::createRedirectRule();

        $userAgent = UserAgent::linuxPlatformToken();

        /** @var OperationSystemCondition $condition */
        $condition = resolve(OperationSystemCondition::class);
        $condition->setUserAgent($userAgent);

        self::assertTrue(
            $condition->passes($rule, '/from/url'),
            $userAgent . ' does not matches the GNU/Linux family.'
        );
    }
}
