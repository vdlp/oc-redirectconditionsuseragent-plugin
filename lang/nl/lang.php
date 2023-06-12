<?php

declare(strict_types=1);

return [
    'crawler' => [
        'description' => 'Crawler',
        'explanation' => 'Een crawler is een programma dat systematisch het World Wide Web doorzoekt om een index van gegevens te maken. Met deze voorwaarde kunt u een redirect maken wanneer een crawler wordt gedetecteerd.',
        'label' => 'Alleen crawlers matchen',
    ],
    'device' => [
        'description' => 'Apparaat',
        'explanation' => 'Specificeer voor welk apparaat (of apparaten) deze redirect van toepassing is.',
        'label' => 'Apparaat',
        'comment' => 'Selecteer niets om deze voorwaarde te negeren.',
        'option_smartphone' => 'Smartphone',
        'option_tablet' => 'Tablet',
        'option_desktop' => 'Desktop',
    ],
    'os' => [
        'description' => 'Besturingssysteem',
        'explanation' => 'Specificeer voor welk besturingssysteem (of besturingssystemen) deze redirect van toepassing is.',
        'label' => 'Besturingssystemen (familie)',
    ],
];
