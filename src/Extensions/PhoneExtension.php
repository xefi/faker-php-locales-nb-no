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

    /**
     * Generate a phone number, keeping a separator between the indicator and the number.
     *
     * @param string|null $format
     * @param string      $separator
     * @param string|null $prefix
     *
     * @return string
     */
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if ($prefix === $this->indicator) {
            $prefix .= $separator;
        }

        return parent::phoneNumber($format, $separator, $prefix);
    }
}
