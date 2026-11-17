<?php

namespace Xefi\Faker\NbNo\Extensions;

use Xefi\Faker\Extensions\ColorsExtension as BaseColorsExtension;

class ColorsExtension extends BaseColorsExtension
{
    /**
     * Get the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): string|null
    {
        return 'nb_NO';
    }

    protected array $safeColorNames = [
        'Svart', 'Rødbrun', 'Grønn', 'Marineblå', 'Olivengrønn',
        'Lilla', 'Blågrønn', 'Limegrønn', 'Blå', 'Sølv',
        'Grå', 'Gul', 'Fuksia', 'Akva', 'Hvit',
    ];

    protected array $colorNames = [
        'Svart', 'Rødbrun', 'Grønn', 'Marineblå', 'Olivengrønn',
        'Lilla', 'Blågrønn', 'Limegrønn', 'Blå', 'Sølv',
        'Grå', 'Gul', 'Fuksia', 'Akva', 'Hvit',
        'Beige', 'Sjokolade', 'Korall', 'Cyan', 'Karmosin',
        'Mørkeblå', 'Mørkeoransje', 'Teglrød', 'Havgrønn', 'Blomsterhvit',
        'Skoggrønn', 'Gull', 'Rosa', 'Indigo', 'Kaki',
        'Lavendel', 'Lyseblå', 'Lysekorall', 'Lysegrønn', 'Lyselaks',
        'Lin', 'Magenta', 'Mellomblå', 'Mellomorkidé', 'Mokkasin',
        'Oransje', 'Rød', 'Plomme', 'Peru', 'Kongeblå',
        'Laks', 'Sandbrun', 'Himmelblå', 'Snøhvit', 'Turkis',
        'Fiolett', 'Røykhvit',
    ];
}
