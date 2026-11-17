<?php

namespace Xefi\Faker\NbNo\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertEquals(15, strlen($iban));
            $this->assertMatchesRegularExpression('/^NO\d{13}$/', $iban);
            $this->assertTrue(Iban::isValid($iban));

            $sum = 0;
            foreach ([5, 4, 3, 2, 7, 6, 5, 4, 3, 2] as $index => $weight) {
                $sum += $weight * (int) $iban[4 + $index];
            }
            $this->assertSame((11 - $sum % 11) % 11, (int) $iban[14], "IBAN '{$iban}' has an invalid national check digit.");
        }
    }
}
