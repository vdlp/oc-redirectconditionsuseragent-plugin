<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Classes;

use DeviceDetector\DeviceDetector;
use Illuminate\Http\Request;
use Vdlp\Redirect\Classes\RedirectRule;
use Vdlp\RedirectConditions\Classes\Condition;
use Vdlp\RedirectConditionsUserAgent\Traits\UserAgent;

class DeviceCondition extends Condition
{
    use UserAgent;

    public function __construct(
        private Request $request,
    ) {
    }

    public function getCode(): string
    {
        return 'vdlp_device';
    }

    public function getDescription(): string
    {
        return 'vdlp.redirectconditionsuseragent::lang.device.description';
    }

    public function getExplanation(): string
    {
        return 'vdlp.redirectconditionsuseragent::lang.device.explanation';
    }

    public function passes(RedirectRule $rule, string $requestUri): bool
    {
        $parameters = $this->getParameters($rule->getId());

        $allowedDevices = $parameters['allowed_devices'] ?? [];

        if (empty($allowedDevices)) {
            return true;
        }

        $detector = new DeviceDetector((string) ($this->userAgent ?? $this->request->userAgent()));
        $detector->parse();

        if ($detector->isBot()) {
            return false;
        }

        if (in_array('smartphone', $allowedDevices, true) && $detector->isSmartphone()) {
            return true;
        }

        if (in_array('tablet', $allowedDevices, true) && $detector->isTablet()) {
            return true;
        }

        if (in_array('desktop', $allowedDevices, true) && $detector->isDesktop()) {
            return true;
        }

        return false;
    }

    public function getFormConfig(): array
    {
        return [
            'allowed_devices' => [
                'tab' => self::TAB_NAME,
                'label' => 'vdlp.redirectconditionsuseragent::lang.device.label',
                'comment' => 'vdlp.redirectconditionsuseragent::lang.device.comment',
                'type' => 'checkboxlist',
                'span' => 'left',
                'options' => [
                    'smartphone' => 'vdlp.redirectconditionsuseragent::lang.device.option_smartphone',
                    'tablet' => 'vdlp.redirectconditionsuseragent::lang.device.option_tablet',
                    'desktop' => 'vdlp.redirectconditionsuseragent::lang.device.option_desktop',
                ],
            ],
        ];
    }
}
