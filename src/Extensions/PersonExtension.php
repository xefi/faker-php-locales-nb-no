<?php

namespace Xefi\Faker\NbNo\Extensions;

use DateTimeImmutable;
use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
{
    /**
     * Get the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'nb_NO';
    }

    protected $firstNameMale = [
        'Jan', 'Per', 'Bjørn', 'Ole', 'Lars', 'Kjell', 'Knut', 'Arne', 'Svein', 'Thomas',
        'Hans', 'Geir', 'Tor', 'Morten', 'Terje', 'Odd', 'Erik', 'Martin', 'Andreas', 'John',
        'Anders', 'Rune', 'Trond', 'Tore', 'Jon', 'Harald', 'Magnus', 'Henrik', 'Jonas', 'Emil',
        'Kristian', 'Sindre', 'Even', 'Eirik', 'Håkon', 'Sigurd', 'Olav', 'Aksel', 'Filip', 'Johannes',
    ];

    protected $firstNameFemale = [
        'Anne', 'Inger', 'Kari', 'Marit', 'Ingrid', 'Liv', 'Eva', 'Berit', 'Astrid', 'Bjørg',
        'Hilde', 'Anna', 'Solveig', 'Marianne', 'Randi', 'Ida', 'Nina', 'Ragnhild', 'Elisabeth', 'Kristin',
        'Silje', 'Ingeborg', 'Tone', 'Hege', 'Nora', 'Emma', 'Sofie', 'Maja', 'Ella', 'Sara',
        'Thea', 'Ingvild', 'Julie', 'Live', 'Tuva', 'Frida', 'Sigrid', 'Synnøve', 'Aud', 'Gunn',
    ];

    protected $lastName = [
        'Hansen', 'Johansen', 'Olsen', 'Larsen', 'Andersen', 'Pedersen', 'Nilsen', 'Kristiansen', 'Jensen', 'Karlsen',
        'Johnsen', 'Pettersen', 'Eriksen', 'Berg', 'Haugen', 'Hagen', 'Johannessen', 'Andreassen', 'Jacobsen', 'Dahl',
        'Jørgensen', 'Halvorsen', 'Henriksen', 'Lund', 'Sørensen', 'Moen', 'Gundersen', 'Iversen', 'Strand', 'Solberg',
        'Svendsen', 'Eide', 'Knutsen', 'Martinsen', 'Paulsen', 'Bakken', 'Kristoffersen', 'Mathisen', 'Lie', 'Amundsen',
    ];

    protected $titleMale = ['Hr.', 'Dr.', 'Prof.'];
    protected $titleFemale = ['Fru', 'Frk.', 'Dr.', 'Prof.'];

    /**
     * Get a random national identity number (fødselsnummer) with both of its control digits.
     *
     * @param ?string $gender
     * @param bool    $formatted
     *
     * @return string
     */
    public function fodselsnummer(?string $gender = null, bool $formatted = false): string
    {
        $year = $this->randomizer->getInt(1940, 2023);
        $month = $this->randomizer->getInt(1, 12);
        $daysInMonth = (int) (new DateTimeImmutable(sprintf('%04d-%02d-01', $year, $month)))->format('t');
        $day = $this->randomizer->getInt(1, $daysInMonth);

        $date = sprintf('%02d%02d%02d', $day, $month, $year % 100);
        $individualRanges = $year >= 2000 ? [[500, 999]] : [[0, 499], [900, 999]];

        do {
            [$min, $max] = $this->pickArrayRandomElement($individualRanges);
            $individualNumber = $this->randomizer->getInt($min, $max);

            if ($gender === static::GENDER_MALE && $individualNumber % 2 === 0) {
                $individualNumber++;
            } elseif ($gender === static::GENDER_FEMALE && $individualNumber % 2 === 1) {
                $individualNumber--;
            }

            $base = sprintf('%s%03d', $date, $individualNumber);
            $firstControlDigit = $this->controlDigit($base, [3, 7, 6, 1, 8, 9, 4, 5, 2]);
            $secondControlDigit = $firstControlDigit === null
                ? null
                : $this->controlDigit($base.$firstControlDigit, [5, 4, 3, 2, 7, 6, 5, 4, 3, 2]);
        } while ($secondControlDigit === null);

        $fodselsnummer = $base.$firstControlDigit.$secondControlDigit;

        if ($formatted) {
            return sprintf('%s %s', substr($fodselsnummer, 0, 6), substr($fodselsnummer, 6, 5));
        }

        return $fodselsnummer;
    }

    /**
     * Compute a modulus 11 control digit for the given digits and weights, or null when it would be 10.
     *
     * @param string $digits
     * @param int[]  $weights
     *
     * @return int|null
     */
    private function controlDigit(string $digits, array $weights): ?int
    {
        $sum = 0;
        foreach ($weights as $index => $weight) {
            $sum += $weight * (int) $digits[$index];
        }

        $controlDigit = (11 - $sum % 11) % 11;

        return $controlDigit === 10 ? null : $controlDigit;
    }
}
