<?php

namespace Xefi\Faker\NbNo\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
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

    /**
     * Get a random IBAN, a Norwegian one (eleven digits account number with its modulus 11 check digit) by default.
     *
     * @param ?string $countryCode
     * @param ?string $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'NO';
        }

        if ($format === null) {
            $format = $this->accountNumber();
        }

        return parent::iban($countryCode, $format);
    }

    /**
     * Build an eleven digits account number (kontonummer) whose last digit is its modulus 11 check digit.
     *
     * @return string
     */
    private function accountNumber(): string
    {
        $weights = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];

        do {
            $digits = $this->formatString(str_repeat('{d}', 10));

            $sum = 0;
            foreach ($weights as $index => $weight) {
                $sum += $weight * (int) $digits[$index];
            }

            $checkDigit = (11 - $sum % 11) % 11;
        } while ($checkDigit === 10);

        return $digits.$checkDigit;
    }
}
