# Faker PHP — nb_NO locale

Norwegian Bokmål (`nb_NO`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-nb-no
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('nb_NO');

$faker->name();           // "Ingrid Hansen"
$faker->fullAddress();    // "Storgata 12, 0150 Oslo"
$faker->fodselsnummer();  // "01010012356"
```

Generators without a `nb_NO` variant fall back to the default locale.

## Locale-specific generators

| Method | Extension | Description |
| --- | --- | --- |
| `county()` / `countyCode()` | Address | The 15 fylker and their fylkesnummer |
| `postcode()` | Address | 4 digits postnummer |
| `fodselsnummer(?string $gender, bool $formatted)` | Person | Fødselsnummer with both control digits |
| `companyNumber()` | Company | Organisasjonsnummer passing the modulus 11 check |
| `vat()` | Company | `NO` + organisasjonsnummer + `MVA` |
| `iban()` | Financial | `NO` IBAN with a valid national modulus 11 check digit |

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerNbNoServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
