<?php

namespace Xefi\Faker\NbNo\Tests\Unit;

use Random\Randomizer;
use Xefi\Faker\NbNo\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new \ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing(
            $this->companies,
            $results
        );
    }

    public function testCompanyNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->unique()->companyNumber();

            $this->assertMatchesRegularExpression('/^[89]\d{8}$/', $result);
            $this->assertTrue($this->isValidOrganisationNumber($result), "Organisation number '{$result}' fails the modulus 11 check.");
        }
    }

    public function testVat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->unique()->vat();

            $this->assertMatchesRegularExpression('/^NO[89]\d{8}MVA$/', $result);
            $this->assertTrue($this->isValidOrganisationNumber(substr($result, 2, 9)), "VAT number '{$result}' is not built on a valid organisation number.");
        }
    }

    /**
     * Check an organisation number against its modulus 11 check digit.
     *
     * @param string $number
     *
     * @return bool
     */
    private function isValidOrganisationNumber(string $number): bool
    {
        $sum = 0;
        foreach ([3, 2, 7, 6, 5, 4, 3, 2] as $index => $weight) {
            $sum += $weight * (int) $number[$index];
        }

        return (11 - $sum % 11) % 11 === (int) $number[8];
    }
}
