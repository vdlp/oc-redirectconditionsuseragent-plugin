<?php

declare(strict_types=1);

return [
    'crawler' => [
        'description' => 'Crawler',
        'explanation' => 'A crawler is a program that systematically browses the World Wide Web in order to create an index of data. This condition allows you to redirect when a crawler is detected.',
        'label' => 'Match crawlers only',
    ],
    'device' => [
        'description' => 'Device',
        'explanation' => 'Specify for which device(s) this redirect rule applies.',
        'label' => 'Device',
        'comment' => 'Select nothing to ignore this condition.',
        'option_smartphone' => 'Smartphone',
        'option_tablet' => 'Tablet',
        'option_desktop' => 'Desktop',
    ],
    'os' => [
        'description' => 'Operating system',
        'explanation' => 'Specify for which operating system(s) this redirect rule applies.',
        'label' => 'Operating system family',
    ],
];
