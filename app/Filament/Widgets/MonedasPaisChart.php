<?php

namespace App\Filament\Widgets;

use App\Models\Monedas;
use Filament\Widgets\ChartWidget;

class MonedasPaisChart extends ChartWidget
{
    public ?string $filter = 'ALL';  // ALL como valor por defecto para mostrar todos los países

    protected static ?string $heading = 'Monedas por País';
    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        // Iniciamos la consulta base
        $query = Monedas::where('user_id', auth()->id());

        // Aplicamos el filtro si no es 'ALL'
        if ($this->filter !== 'ALL') {
            $query->where('pais', $this->filter);
        }

        // Obtenemos los datos agrupados
        $data = $query->selectRaw('pais, COUNT(*) as total')
            ->groupBy('pais')
            ->orderByDesc('total')
            ->get();

        return [
            'labels' => $data->pluck('pais')->toArray(),
            'datasets' => [
                [
                    'label' => 'Cantidad de Monedas',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => $this->getColorPalette($data->count()),
                ],
            ],
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'ALL' => 'Todos',
            'AF' => 'Afganistán',
                'AL' => 'Albania',
                'DZ' => 'Argelia',
                'AS' => 'Samoa Americana',
                'AD' => 'Andorra',
                'AO' => 'Angola',
                'AG' => 'Antigua y Barbuda',
                'AR' => 'Argentina',
                'AM' => 'Armenia',
                'AU' => 'Australia',
                'AT' => 'Austria',
                'AZ' => 'Azerbaiyán',
                'BS' => 'Bahamas',
                'BH' => 'Baréin',
                'BD' => 'Bangladés',
                'BB' => 'Barbados',
                'BY' => 'Bielorrusia',
                'BE' => 'Bélgica',
                'BZ' => 'Belice',
                'BJ' => 'Benín',
                'BT' => 'Bután',
                'BO' => 'Bolivia',
                'BA' => 'Bosnia y Herzegovina',
                'BW' => 'Botsuana',
                'BR' => 'Brasil',
                'BN' => 'Brunéi',
                'BG' => 'Bulgaria',
                'BF' => 'Burkina Faso',
                'BI' => 'Burundi',
                'CV' => 'Cabo Verde',
                'KH' => 'Camboya',
                'CM' => 'Camerún',
                'CA' => 'Canadá',
                'KY' => 'Islas Caimán',
                'CF' => 'República Centroafricana',
                'TD' => 'Chad',
                'CL' => 'Chile',
                'CN' => 'China',
                'CO' => 'Colombia',
                'KM' => 'Comoras',
                'CG' => 'Congo',
                'CD' => 'Congo (RDC)',
                'CR' => 'Costa Rica',
                'CI' => 'Costa de Marfil',
                'HR' => 'Croacia',
                'CU' => 'Cuba',
                'CY' => 'Chipre',
                'CZ' => 'República Checa',
                'DK' => 'Dinamarca',
                'DJ' => 'Yibuti',
                'DM' => 'Dominica',
                'DO' => 'República Dominicana',
                'EC' => 'Ecuador',
                'EG' => 'Egipto',
                'SV' => 'El Salvador',
                'GQ' => 'Guinea Ecuatorial',
                'ER' => 'Eritrea',
                'EE' => 'Estonia',
                'SZ' => 'Esuatini',
                'ET' => 'Etiopía',
                'FJ' => 'Fiyi',
                'FI' => 'Finlandia',
                'FR' => 'Francia',
                'GA' => 'Gabón',
                'GM' => 'Gambia',
                'GE' => 'Georgia',
                'DE' => 'Alemania',
                'GH' => 'Ghana',
                'GR' => 'Grecia',
                'GD' => 'Granada',
                'GT' => 'Guatemala',
                'GN' => 'Guinea',
                'GW' => 'Guinea-Bisáu',
                'GY' => 'Guyana',
                'HT' => 'Haití',
                'HN' => 'Honduras',
                'HU' => 'Hungría',
                'IS' => 'Islandia',
                'IN' => 'India',
                'ID' => 'Indonesia',
                'IR' => 'Irán',
                'IQ' => 'Irak',
                'IE' => 'Irlanda',
                'IL' => 'Israel',
                'IT' => 'Italia',
                'JM' => 'Jamaica',
                'JP' => 'Japón',
                'JO' => 'Jordania',
                'KZ' => 'Kazajistán',
                'KE' => 'Kenia',
                'KI' => 'Kiribati',
                'KW' => 'Kuwait',
                'KG' => 'Kirguistán',
                'LA' => 'Laos',
                'LV' => 'Letonia',
                'LB' => 'Líbano',
                'LS' => 'Lesoto',
                'LR' => 'Liberia',
                'LY' => 'Libia',
                'LI' => 'Liechtenstein',
                'LT' => 'Lituania',
                'LU' => 'Luxemburgo',
                'MG' => 'Madagascar',
                'MW' => 'Malaui',
                'MY' => 'Malasia',
                'MV' => 'Maldivas',
                'ML' => 'Malí',
                'MT' => 'Malta',
                'MH' => 'Islas Marshall',
                'MR' => 'Mauritania',
                'MU' => 'Mauricio',
                'MX' => 'México',
                'FM' => 'Micronesia',
                'MD' => 'Moldavia',
                'MC' => 'Mónaco',
                'MN' => 'Mongolia',
                'ME' => 'Montenegro',
                'MA' => 'Marruecos',
                'MZ' => 'Mozambique',
                'MM' => 'Myanmar',
                'NA' => 'Namibia',
                'NR' => 'Nauru',
                'NP' => 'Nepal',
                'NL' => 'Países Bajos',
                'NZ' => 'Nueva Zelanda',
                'NI' => 'Nicaragua',
                'NE' => 'Níger',
                'NG' => 'Nigeria',
                'NO' => 'Noruega',
                'OM' => 'Omán',
                'PK' => 'Pakistán',
                'PW' => 'Palaos',
                'PA' => 'Panamá',
                'PG' => 'Papúa Nueva Guinea',
                'PY' => 'Paraguay',
                'PE' => 'Perú',
                'PH' => 'Filipinas',
                'PL' => 'Polonia',
                'PT' => 'Portugal',
                'QA' => 'Catar',
                'RO' => 'Rumanía',
                'RU' => 'Rusia',
                'RW' => 'Ruanda',
                'KN' => 'San Cristóbal y Nieves',
                'LC' => 'Santa Lucía',
                'VC' => 'San Vicente y las Granadinas',
                'WS' => 'Samoa',
                'SM' => 'San Marino',
                'ST' => 'Santo Tomé y Príncipe',
                'SA' => 'Arabia Saudita',
                'SN' => 'Senegal',
                'RS' => 'Serbia',
                'SC' => 'Seychelles',
                'SL' => 'Sierra Leona',
                'SG' => 'Singapur',
                'SK' => 'Eslovaquia',
                'SI' => 'Eslovenia',
                'SB' => 'Islas Salomón',
                'SO' => 'Somalia',
                'ZA' => 'Sudáfrica',
                'SS' => 'Sudán del Sur',
                'ES' => 'España',
                'LK' => 'Sri Lanka',
                'SD' => 'Sudán',
                'SR' => 'Surinam',
                'SE' => 'Suecia',
                'CH' => 'Suiza',
                'SY' => 'Siria',
                'TW' => 'Taiwán',
                'TJ' => 'Tayikistán',
                'TZ' => 'Tanzania',
                'TH' => 'Tailandia',
                'TL' => 'Timor Oriental',
                'TG' => 'Togo',
                'TO' => 'Tonga',
                'TT' => 'Trinidad y Tobago',
                'TN' => 'Túnez',
                'TR' => 'Turquía',
                'TM' => 'Turkmenistán',
                'TV' => 'Tuvalu',
                'UG' => 'Uganda',
                'UA' => 'Ucrania',
                'AE' => 'Emiratos Árabes Unidos',
                'GB' => 'Reino Unido',
                'US' => 'Estados Unidos',
                'UY' => 'Uruguay',
                'UZ' => 'Uzbekistán',
                'VU' => 'Vanuatu',
                'VE' => 'Venezuela',
                'VN' => 'Vietnam',
                'YE' => 'Yemen',
                'ZM' => 'Zambia',
                'ZW' => 'Zimbabue',
        ];
    }

    private function getColorPalette(int $count): array
    {
        $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
            '#FF9F40', '#E7E9ED', '#50B432', '#ED561B', '#24CBE5',
        ];

        return array_slice(array_pad($colors, $count, $colors), 0, $count);
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'display' => false, // Oculta el eje X y sus líneas
                ],
                'y' => [
                    'display' => false, // Oculta el eje Y y sus líneas
                ],
            ],
        ];
    }
    public function height(): string
    {
        return '450px'; // Default widget height
    }

}