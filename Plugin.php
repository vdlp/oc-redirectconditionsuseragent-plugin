<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent;

use System\Classes\PluginBase;
use Vdlp\Redirect\Classes\Contracts\RedirectManagerInterface;
use Vdlp\RedirectConditionsUserAgent\Classes\CrawlerCondition;
use Vdlp\RedirectConditionsUserAgent\Classes\DeviceCondition;
use Vdlp\RedirectConditionsUserAgent\Classes\OperatingSystemCondition;

final class Plugin extends PluginBase
{
    /**
     * @inheritdoc
     */
    public $require = [
        'Vdlp.RedirectConditions',
    ];

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

    public function boot(): void
    {
        /** @var RedirectManagerInterface $manager */
        $manager = resolve(RedirectManagerInterface::class);
        $manager->addCondition(CrawlerCondition::class, 10);
        $manager->addCondition(OperatingSystemCondition::class, 20);
        $manager->addCondition(DeviceCondition::class, 30);
    }
}
