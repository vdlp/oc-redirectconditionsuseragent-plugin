<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsUserAgent\Classes;

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\OperatingSystem;
use Illuminate\Http\Request;
use Vdlp\Redirect\Classes\RedirectRule;
use Vdlp\RedirectConditions\Classes\Condition;
use Vdlp\RedirectConditionsUserAgent\Traits\UserAgent;

class OperatingSystemCondition extends Condition
{
    use UserAgent;

    public function __construct(
        private Request $request,
    ) {
    }

    public function getCode(): string
    {
        return 'vdlp_os';
    }

    public function getDescription(): string
    {
        return 'vdlp.redirectconditionsuseragent::lang.os.description';
    }

    public function getExplanation(): string
    {
        return 'vdlp.redirectconditionsuseragent::lang.os.explanation';
    }

    public function passes(RedirectRule $rule, string $requestUri): bool
    {
        $parameters = $this->getParameters($rule->getId());

        $allowedOsFamilies = $parameters['allowed_os_families'] ?? [];

        if (empty($allowedOsFamilies)) {
            return true;
        }

        $detector = new DeviceDetector((string) ($this->userAgent ?? $this->request->userAgent()));
        $detector->parse();

        $osLabel = $detector->getOs()['short_name'] ?? null;

        $osFamily = OperatingSystem::getOsFamily($osLabel);

        return $osFamily && in_array($osFamily, $allowedOsFamilies, true);
    }

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
                'label' => 'vdlp.redirectconditionsuseragent::lang.os.label',
                'type' => 'checkboxlist',
                'span' => 'left',
                'options' => $options,
            ],
        ];
    }
}
