<?php

namespace Xefi\Faker\NbNo\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumberReturnsString(): void
    {
        $number = $this->faker->phoneNumber();

        $this->assertIsString($number);
        $this->assertNotEmpty($number);
    }

    public function testPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[2-79]\d{7}$/', $this->faker->phoneNumber());
        }
    }

    public function testCellPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[49]\d{7}$/', $this->faker->cellPhoneNumber());
        }
    }

    public function testLandlinePhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[23567]\d{7}$/', $this->faker->landlinePhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+47[2-79]\d{7}$/', $this->faker->indicatoredPhoneNumber());
        }
    }

    public function testSpacedCellPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[49]\d{2} \d{2} \d{3}$/', $this->faker->spacedCellPhoneNumber());
        }
    }
}
