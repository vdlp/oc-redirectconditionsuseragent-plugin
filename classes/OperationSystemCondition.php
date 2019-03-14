<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Classes;

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\OperatingSystem;
use Illuminate\Http\Request;
use Vdlp\Redirect\Classes\RedirectRule;
use Vdlp\RedirectConditions\Classes\Condition;
use Vdlp\RedirectConditionsUserAgent\Traits\UserAgent;

/**
 * Class BrowserCondition
 *
 * @package Vdlp\RedirectConditionsUserAgent\Classes
 */
class OperationSystemCondition extends Condition
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
        return 'vdlp_os';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): string
    {
        return 'Operating system';
    }

    /**
     * {@inheritdoc}
     */
    public function getExplanation(): string
    {
        return 'Specify for which operation system(s) this redirect rule applies.';
    }

    /**
     * {@inheritdoc}
     */
    public function passes(RedirectRule $rule, string $requestUri): bool
    {
        $parameters = $this->getParameters($rule->getId());

        $allowedOsFamilies = $parameters['allowed_os_families'] ?? [];

        if (empty($allowedOsFamilies)) {
            return true;
        }

        $detector = new DeviceDetector($this->userAgent ?? $this->request->userAgent());
        $detector->parse();

        $osLabel = $detector->getOs()['short_name'] ?? null;

        $osFamily = OperatingSystem::getOsFamily($osLabel);

        return $osFamily && in_array($osFamily, $allowedOsFamilies, true);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormConfig(): array
    {
        $families = array_keys(OperatingSystem::getAvailableOperatingSystemFamilies());

        $options = [];

        foreach ($families as $family) {
            $options[$family] = $family;
        }

        return [
            'allowed_os_families' => [
                'tab' => self::TAB_NAME,
                'label' => 'Operation system family',
                'type' => 'checkboxlist',
                'span' => 'left',
                'options' => $options
            ]
        ];
    }
}
