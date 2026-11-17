<?php

namespace Xefi\Faker\NbNo\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
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

    protected $counties = [
        'Oslo' => '03', 'Rogaland' => '11', 'Møre og Romsdal' => '15', 'Nordland' => '18', 'Østfold' => '31',
        'Akershus' => '32', 'Buskerud' => '33', 'Innlandet' => '34', 'Vestfold' => '39', 'Telemark' => '40',
        'Agder' => '42', 'Vestland' => '46', 'Trøndelag' => '50', 'Troms' => '55', 'Finnmark' => '56',
    ];

    protected $cities = [
        'Oslo', 'Bergen', 'Trondheim', 'Stavanger', 'Drammen', 'Fredrikstad', 'Kristiansand', 'Sandnes', 'Tromsø', 'Sarpsborg',
        'Skien', 'Ålesund', 'Sandefjord', 'Haugesund', 'Tønsberg', 'Moss', 'Porsgrunn', 'Bodø', 'Arendal', 'Hamar',
        'Larvik', 'Halden', 'Lillehammer', 'Molde', 'Harstad', 'Gjøvik', 'Kongsberg', 'Horten', 'Steinkjer', 'Alta',
        'Narvik', 'Kristiansund', 'Lillestrøm', 'Elverum', 'Mo i Rana',
    ];

    protected $streetSuffixes = [
        'gata', 'gate', 'veien', 'vegen', 'stien', 'bakken', 'svingen', 'tunet',
    ];

    protected $streetNames = [
        'Stor', 'Kirke', 'Skole', 'Strand', 'Mølle', 'Skog', 'Fjell', 'Bjørke', 'Gran', 'Furu',
        'Eike', 'Bakke', 'Sjø', 'Havne', 'Torg', 'Jernbane', 'Stasjons', 'Ny', 'Elve', 'Sol',
        'Lyng', 'Myr', 'Ås', 'Dal', 'Bekke', 'Prestegårds', 'Kongens', 'Dronningens', 'Prinsens', 'Rådhus',
        'Brygge', 'Fjord', 'Vang', 'Nordre', 'Søndre', 'Øvre',
    ];

    /**
     * Get a random county (fylke) name.
     *
     * @return string
     */
    public function county(): string
    {
        return $this->pickArrayRandomKey($this->counties);
    }

    /**
     * Get a random county number (fylkesnummer).
     *
     * @return string
     */
    public function countyCode(): string
    {
        return $this->pickArrayRandomElement($this->counties);
    }

    /**
     * Get a random city name.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomElement($this->cities);
    }

    /**
     * Get a random four digits postcode (postnummer).
     *
     * @return string
     */
    public function postcode(): string
    {
        return sprintf('%04d', $this->randomizer->getInt(1, 9991));
    }

    /**
     * Get a random house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 250);
    }

    /**
     * Get a random street name.
     *
     * @return string
     */
    public function streetName(): string
    {
        return $this->pickArrayRandomElement($this->streetNames).$this->pickArrayRandomElement($this->streetSuffixes);
    }

    /**
     * Get a random street address.
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%s %d', $this->streetName(), $this->houseNumber());
    }

    /**
     * Get a random full address.
     *
     * @return string
     */
    public function fullAddress(): string
    {
        return sprintf('%s, %s %s', $this->streetAddress(), $this->postcode(), $this->city());
    }
}
