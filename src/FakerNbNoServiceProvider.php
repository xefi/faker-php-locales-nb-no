<?php

namespace Xefi\Faker\NbNo;

use Xefi\Faker\NbNo\Extensions\AddressExtension;
use Xefi\Faker\NbNo\Extensions\ColorsExtension;
use Xefi\Faker\NbNo\Extensions\CompanyExtension;
use Xefi\Faker\NbNo\Extensions\FinancialExtension;
use Xefi\Faker\NbNo\Extensions\PersonExtension;
use Xefi\Faker\NbNo\Extensions\PhoneExtension;
use Xefi\Faker\NbNo\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerNbNoServiceProvider extends Provider
{
    /**
     * Register the nb_NO extensions.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            TextExtension::class,
            PhoneExtension::class,
        ]);
    }
}
