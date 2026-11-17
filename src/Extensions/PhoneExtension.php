<?php

namespace Xefi\Faker\NbNo\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $indicator = '+47';

    /**
     * Get the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'nb_NO';
    }

    protected array $landlineFormats = [
        '2{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '3{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '5{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '6{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '7{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
    ];

    protected array $cellFormats = [
        '4{d}{d}{separator}{d}{d}{separator}{d}{d}{d}',
        '9{d}{d}{separator}{d}{d}{separator}{d}{d}{d}',
    ];
}
