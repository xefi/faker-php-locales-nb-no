<?php

namespace Xefi\Faker\NbNo\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
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

    private array $companies = [
        'Hansen & Sønn AS', 'Vestlandske Byggfirma AS', 'Johansen Rørlegger AS',
        'Nordlys Energi ASA', 'Fjordkraft Rådgivning AS', 'Bergen Havnelogistikk AS',
        'Trøndersk Tømmer SA', 'Oslo Programvare AS', 'Lofoten Fiskeeksport AS',
        'Olsen & Larsen Advokatfirma DA', 'Sørlandet Ferie AS', 'Hardanger Fruktlager SA',
        'Stavanger Offshore Service ASA', 'Telemark Treindustri AS', 'Finnmark Reinprodukter AS',
        'Nilsen Elektro AS', 'Mjøsa Transport AS', 'Romsdal Maskin AS',
        'Vestfold Revisjon DA', 'Tromsø Arktiske Turer AS', 'Hedmark Landbrukssamvirke SA',
        'Pedersen Arkitekter AS', 'Kystverftet AS', 'Østfold Emballasje AS',
        'Gudbrandsdal Ysteri AS', 'Haugaland Mekaniske AS', 'Nordnorsk Medieforlag AS',
        'Sognefjord Kraftlag SA', 'Kristiansen Bakeri AS', 'Agder Teknologi ASA',
    ];

    /**
     * Get a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Get a random organisation number (organisasjonsnummer) with its modulus 11 check digit.
     *
     * @return string
     */
    public function companyNumber(): string
    {
        $weights = [3, 2, 7, 6, 5, 4, 3, 2];

        do {
            $digits = (string) $this->randomizer->getInt(80000000, 99999999);

            $sum = 0;
            foreach ($weights as $index => $weight) {
                $sum += $weight * (int) $digits[$index];
            }

            $checkDigit = (11 - $sum % 11) % 11;
        } while ($checkDigit === 10);

        return $digits.$checkDigit;
    }

    /**
     * Get a random VAT number (MVA-nummer), built on an organisation number.
     *
     * @return string
     */
    public function vat(): string
    {
        return sprintf('NO%sMVA', $this->companyNumber());
    }
}
