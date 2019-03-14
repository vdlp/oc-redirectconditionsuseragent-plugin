<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Classes;

use DeviceDetector\DeviceDetector;
use Illuminate\Http\Request;
use Vdlp\Redirect\Classes\RedirectRule;
use Vdlp\RedirectConditions\Classes\Condition;
use Vdlp\RedirectConditionsUserAgent\Traits\UserAgent;

/**
 * Class DeviceCondition
 *
 * @package Vdlp\RedirectConditionsUserAgent\Classes
 */
class DeviceCondition extends Condition
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
        return 'vdlp_device';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): string
    {
        return 'Device';
    }

    /**
     * {@inheritdoc}
     */
    public function getExplanation(): string
    {
        return 'Specify for which device(s) this redirect rule applies.';
    }

    /**
     * {@inheritdoc}
     */
    public function passes(RedirectRule $rule, string $requestUri): bool
    {
        $parameters = $this->getParameters($rule->getId());

        $allowedDevices = $parameters['allowed_devices'] ?? [];

        if (empty($allowedDevices)) {
            return true;
        }

        $detector = new DeviceDetector($this->userAgent ?? $this->request->userAgent());
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

    /**
     * {@inheritdoc}
     */
    public function getFormConfig(): array
    {
        return [
            'allowed_devices' => [
                'tab' => self::TAB_NAME,
                'label' => 'Device',
                'comment' => 'Select nothing to ignore this condition.',
                'type' => 'checkboxlist',
                'span' => 'left',
                'options' => [
                    'smartphone' => 'Smartphone',
                    'tablet' => 'Tablet',
                    'desktop' => 'Desktop'
                ]
            ]
        ];
    }
}
