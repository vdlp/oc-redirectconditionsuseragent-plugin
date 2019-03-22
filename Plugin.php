<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent;

use System\Classes\PluginBase;
use Vdlp\Redirect\Classes\Contracts\RedirectManagerInterface;
use Vdlp\RedirectConditionsUserAgent\Classes\CrawlerCondition;
use Vdlp\RedirectConditionsUserAgent\Classes\DeviceCondition;
use Vdlp\RedirectConditionsUserAgent\Classes\OperationSystemCondition;

/**
 * Class Plugin
 *
 * @package Vdlp\RedirectConditionUserAgent
 */
class Plugin extends PluginBase
{
    /**
     * {@inheritdoc}
     */
    public $require = [
        'Vdlp.Redirect',
        'Vdlp.RedirectConditions',
    ];

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * {@inheritdoc}
     */
    public function pluginDetails(): array
    {
        return [
            'name' => 'Redirect Conditions: UserAgent',
            'description' => 'Adds UserAgent specific conditions to the Redirect plugin.',
            'author' => 'Van der Let & Partners <octobercms@vdlp.nl>',
            'icon' => 'icon-link',
            'homepage' => 'https://octobercms.com/plugin/vdlp-redirectconditionsuseragent',
        ];
    }

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        /** @var RedirectManagerInterface $manager */
        $manager = resolve(RedirectManagerInterface::class);
        $manager->addCondition(CrawlerCondition::class, 10);
        $manager->addCondition(OperationSystemCondition::class, 20);
        $manager->addCondition(DeviceCondition::class, 30);
    }
}
