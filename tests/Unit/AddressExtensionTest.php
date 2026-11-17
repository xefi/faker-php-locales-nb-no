<?php

namespace Xefi\Faker\NbNo\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\NbNo\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected AddressExtension $extension;
    protected array $counties = [];
    protected array $cities = [];
    protected array $streetSuffixes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->extension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($this->extension);

        $this->counties = $reflection->getProperty('counties')->getValue($this->extension);
        $this->cities = $reflection->getProperty('cities')->getValue($this->extension);
        $this->streetSuffixes = $reflection->getProperty('streetSuffixes')->getValue($this->extension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($this->extension);
    }

    public function testCounty(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->counties); $i++) {
            $results[] = $this->faker->unique()->county();
        }

        $this->assertEqualsCanonicalizing(
            array_keys($this->counties),
            $results
        );
    }

    public function testCountyCode(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->counties); $i++) {
            $results[] = $this->faker->unique()->countyCode();
        }

        $this->assertEqualsCanonicalizing(
            array_values($this->counties),
            $results
        );
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(
            $this->cities,
            $results
        );
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->unique()->postcode();

            $this->assertIsString($result);
            $this->assertMatchesRegularExpression('/^\d{4}$/', $result);
            $this->assertGreaterThanOrEqual(1, (int) $result);
            $this->assertLessThanOrEqual(9991, (int) $result);
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->houseNumber();

            $this->assertIsInt($result);
            $this->assertLessThanOrEqual(250, $result);
            $this->assertGreaterThanOrEqual(1, $result);
        }
    }

    public function testStreetName(): void
    {
        $streets = [];
        foreach ($this->streetNames as $name) {
            foreach ($this->streetSuffixes as $suffix) {
                $streets[] = $name.$suffix;
            }
        }

        for ($i = 0; $i < 100; $i++) {
            $this->assertContains($this->faker->streetName(), $streets);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\p{L}+ \d{1,3}$/u', $this->faker->streetAddress());
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\p{L}+ \d{1,3}, \d{4} [\p{L} ]+$/u', $this->faker->fullAddress());
        }
    }
}
