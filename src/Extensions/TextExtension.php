<?php

namespace Xefi\Faker\NbNo\Extensions;

use Xefi\Faker\Extensions\TextExtension as BaseTextExtension;

class TextExtension extends BaseTextExtension
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

    /**
     * Text in format => Paragraphs => Sentences => Words.
     *
     * @var array|array[]
     */
    protected array $paragraphs = [
        [
            ['Kvaliteten', 'på', 'tjenestene', 'er', 'fortsatt', 'et', 'sentralt', 'mål', 'i', 'næringslivet.'],
            ['Hvert', 'prosjekt', 'krever', 'særskilt', 'oppmerksomhet', 'for', 'å', 'sikre', 'et', 'godt', 'resultat.'],
            ['Teamene', 'samarbeider', 'tett', 'for', 'å', 'nå', 'de', 'felles', 'målene.'],
            ['God', 'kommunikasjon', 'mellom', 'kollegaene', 'gir', 'høyere', 'produktivitet.'],
        ],
        [
            ['Styringen', 'av', 'ressursene', 'er', 'avgjørende', 'for', 'den', 'samlede', 'ytelsen.'],
            ['Arbeidsmetodene', 'utvikler', 'seg', 'i', 'takt', 'med', 'behovene', 'og', 'teknologien.'],
            ['Tilpasningsevne', 'gjør', 'det', 'mulig', 'for', 'virksomheter', 'å', 'forbli', 'konkurransedyktige', 'og', 'nyskapende.'],
            ['Prosessene', 'blir', 'gjennomgått', 'for', 'å', 'forbedre', 'resultatene', 'og', 'møte', 'kravene', 'i', 'markedet.'],
        ],
        [
            ['Kundenes', 'tilfredshet', 'avhenger', 'av', 'kvaliteten', 'på', 'tjenesten', 'og', 'av', 'responstiden.'],
            ['Nøkkeltall', 'brukes', 'til', 'å', 'måle', 'resultatene', 'og', 'til', 'å', 'styre', 'de', 'strategiske', 'beslutningene.'],
            ['De', 'daglige', 'utfordringene', 'løses', 'takket', 'være', 'god', 'ledelse', 'og', 'riktig', 'kompetanse.'],
            ['En', 'jevnlig', 'evaluering', 'av', 'arbeidsrutinene', 'avdekker', 'mulige', 'forbedringer.'],
        ],
        [
            ['Opplæring', 'og', 'kompetanseutvikling', 'har', 'høy', 'prioritet', 'i', 'bedriftene.'],
            ['Medarbeiderne', 'oppfordres', 'til', 'å', 'tilegne', 'seg', 'nye', 'ferdigheter', 'og', 'til', 'å', 'tenke', 'nytt.'],
            ['Strategier', 'for', 'kontinuerlig', 'forbedring', 'bidrar', 'til', 'å', 'øke', 'ytelsen', 'og', 'redusere', 'risikoen.'],
            ['Tilpassede', 'opplæringsprogrammer', 'støtter', 'både', 'den', 'enkeltes', 'og', 'fellesskapets', 'utvikling.'],
        ],
        [
            ['Dataanalyse', 'hjelper', 'med', 'å', 'finne', 'områder', 'med', 'potensial', 'for', 'vekst', 'og', 'forbedring.'],
            ['Målene', 'justeres', 'etter', 'utviklingen', 'i', 'markedet', 'og', 'kundenes', 'forventninger.'],
            ['Ved', 'å', 'følge', 'fremdriften', 'tett,', 'kan', 'man', 'raskt', 'tilpasse', 'seg', 'endringer.'],
            ['Beslutningene', 'tas', 'på', 'grunnlag', 'av', 'pålitelige', 'data', 'og', 'presise', 'analyser.'],
            ['Jevnlige', 'gjennomganger', 'gjør', 'det', 'mulig', 'å', 'revurdere', 'strategiene', 'og', 'sette', 'inn', 'korrigerende', 'tiltak.'],
        ],
    ];
}
