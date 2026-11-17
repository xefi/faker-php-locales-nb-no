<?php

namespace Xefi\Faker\NbNo\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\NbNo\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new PersonExtension(new Randomizer());
        $this->firstNameMale = (new ReflectionClass($personExtension))->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = (new ReflectionClass($personExtension))->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = (new ReflectionClass($personExtension))->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = (new ReflectionClass($personExtension))->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = (new ReflectionClass($personExtension))->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameFemale,
            $results
        );
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameMale,
            $results
        );
    }

    public function testFirstName(): void
    {
        $results = [];
        $firstnames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));
        for ($i = 0; $i < count($firstnames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing(
            $firstnames,
            $results
        );
    }

    public function testLastName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing(
            $this->lastName,
            $results
        );
    }

    public function testNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->name(PersonExtension::GENDER_MALE);
        }

        foreach ($results as $result) {
            $matchesFirstName = array_filter($this->firstNameMale, function ($firstName) use ($result) {
                return str_contains($result, $firstName);
            });
            $this->assertNotEmpty($matchesFirstName, "The first part of the result '{$result}' does not match any first name.");

            $matchesLastName = array_filter($this->lastName, function ($lastName) use ($result) {
                return str_contains($result, $lastName);
            });
            $this->assertNotEmpty($matchesLastName, "The second part of the result '{$result}' does not match any last name.");
        }
    }

    public function testNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->name(PersonExtension::GENDER_FEMALE);
        }

        foreach ($results as $result) {
            $matchesFirstName = array_filter($this->firstNameFemale, function ($firstName) use ($result) {
                return str_contains($result, $firstName);
            });
            $this->assertNotEmpty($matchesFirstName, "The first part of the result '{$result}' does not match any first name.");

            $matchesLastName = array_filter($this->lastName, function ($lastName) use ($result) {
                return str_contains($result, $lastName);
            });
            $this->assertNotEmpty($matchesLastName, "The second part of the result '{$result}' does not match any last name.");
        }
    }

    public function testName(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->name();
        }

        foreach ($results as $result) {
            $matchesFirstName = array_filter(array_merge($this->firstNameFemale, $this->firstNameMale), function ($firstName) use ($result) {
                return str_contains($result, $firstName);
            });
            $this->assertNotEmpty($matchesFirstName, "The first part of the result '{$result}' does not match any first name.");

            $matchesLastName = array_filter($this->lastName, function ($lastName) use ($result) {
                return str_contains($result, $lastName);
            });
            $this->assertNotEmpty($matchesLastName, "The second part of the result '{$result}' does not match any last name.");
        }
    }

    public function testTitleFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->titleFemale,
            $results
        );
    }

    public function testTitleMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->titleMale,
            $results
        );
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing(
            $titles,
            $results
        );
    }

    public function testFodselsnummerIsValid(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $fodselsnummer = $this->faker->fodselsnummer();

            $this->assertMatchesRegularExpression('/^\d{11}$/', $fodselsnummer);
            $this->assertSame($this->controlDigit($fodselsnummer, [3, 7, 6, 1, 8, 9, 4, 5, 2]), (int) $fodselsnummer[9], "Fødselsnummer '{$fodselsnummer}' has an invalid first control digit.");
            $this->assertSame($this->controlDigit($fodselsnummer, [5, 4, 3, 2, 7, 6, 5, 4, 3, 2]), (int) $fodselsnummer[10], "Fødselsnummer '{$fodselsnummer}' has an invalid second control digit.");
            $this->assertTrue(
                checkdate((int) substr($fodselsnummer, 2, 2), (int) substr($fodselsnummer, 0, 2), $this->birthYear($fodselsnummer)),
                "Fødselsnummer '{$fodselsnummer}' has an invalid birth date."
            );
        }
    }

    public function testFodselsnummerReturnsCorrectGender(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertSame(1, (int) $this->faker->fodselsnummer(PersonExtension::GENDER_MALE)[8] % 2);
            $this->assertSame(0, (int) $this->faker->fodselsnummer(PersonExtension::GENDER_FEMALE)[8] % 2);
        }
    }

    public function testFormattedFodselsnummer(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\d{6} \d{5}$/', $this->faker->fodselsnummer(null, true));
        }
    }

    /**
     * Compute the expected modulus 11 control digit over the leading digits matching the weights.
     *
     * @param string $digits
     * @param int[]  $weights
     *
     * @return int
     */
    private function controlDigit(string $digits, array $weights): int
    {
        $sum = 0;
        foreach ($weights as $index => $weight) {
            $sum += $weight * (int) $digits[$index];
        }

        return (11 - $sum % 11) % 11;
    }

    /**
     * Resolve the full birth year from the two digits year and the individual number of a fødselsnummer.
     *
     * @param string $fodselsnummer
     *
     * @return int
     */
    private function birthYear(string $fodselsnummer): int
    {
        $year = (int) substr($fodselsnummer, 4, 2);
        $individualNumber = (int) substr($fodselsnummer, 6, 3);

        if ($individualNumber <= 499) {
            return 1900 + $year;
        }

        if ($year <= 39) {
            return 2000 + $year;
        }

        return $individualNumber >= 900 ? 1900 + $year : 1800 + $year;
    }
}
