<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BilletesResource\Pages;
use App\Filament\Resources\BilletesResource\RelationManagers;
use App\Models\Billetes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Parfaitementweb\FilamentCountryField\Forms\Components\Country;
use Filament\Forms\Components\Select;
use Parfaitementweb\FilamentCountryField\Tables\Columns\CountryColumn;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Pelmered\FilamentMoneyField\Infolists\Components\MoneyEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Tables\Filters\SelectFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;


class BilletesResource extends Resource
{
    protected static ?string $model = Billetes::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function getNavigationBadge(): ?string
    {
        return (string) Billetes::where('user_id', auth()->id())->count(); 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->label('Nombre'),

                Forms\Components\TextInput::make('denominacion')
                    ->label('Denominacion')
                    ->numeric(),

                FileUpload::make('foto_frontal')
                    ->label('Anverso')
                    ->image() // Esto habilita la previsualización de la imagen
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                    ])
                    ->downloadable()
                    ->directory('storage/uploads/billetes')   //storage/billetes
                    ->openable()
                    ->required(),

                FileUpload::make('foto_trasera')
                    ->label('Reverso')
                    ->image()
                    ->openable()
                    ->directory('storage/uploads/billetes')   //storage/billetes
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                    ])
                    ->imageEditor()
                    ->downloadable()
                    ->required(),

                Forms\Components\TextInput::make('anio')
                    ->label('Año')
                    ->numeric()
                    ->rules('digits:4')
                    ->required(),

                Country::make('pais')
                    ->searchable()
                    ->label('País')
                    ->required(),

                Select::make('estado')
                ->options([
                    'Malo' => 'Malo',
                    'Bueno' => 'Bueno',
                    'Muy Bueno' => 'Muy Bueno',
                    'Excelente' => 'Excelente'               
                    ]),
                
                MoneyInput::make('valor_comprado')
                    ->label('Valor Comprado')
                    ->currency('HNL')
                    ->locale('es_HN')
                    ->minValue(0)
                    ->decimals(2)
                    ->step(100),

                MoneyInput::make('valor_venta_sugerido')
                    ->label('Valor Venta Sugerido')
                    ->step(100)
                    ->currency('HNL')
                    ->locale('es_HN')
                    ->minValue(0)
                    ->decimals(2),

                Forms\Components\DatePicker::make('created_at')
                    ->label('Fecha de Creación')
                    ->disabled()
                    ->default(now()),
        
            ]);
    }

    public static function infolist(Infolist $infolist): infolist
    {
        return $infolist
        ->schema([
            Section::make('Informacion General')
            ->columns(3)
            ->schema([
                TextEntry::make('nombre')
                ->label('Moneda'),
                TextEntry::make('denominacion')
                ->label('Denominacion'),
                TextEntry::make('anio')
                ->label('Año'),

            ]),
        
            Section::make('Valoracion')
            ->columns(3)
            ->schema([
                TextEntry::make('estado')
                ->label('Estado'),
                MoneyEntry::make('valor_comprado')
                ->label('Valor de Compra')
                ->currency('HNL')
                ->locale('es_HN'),
                MoneyEntry::make('valor_venta_sugerido')
                ->label('Valor de Venta Sugerido')
                ->currency('HNL')
                ->locale('es_HN'),

                
            ]),

            Section::make('Imagenes')
            ->columns(1)
            ->schema([
                ImageEntry::make('foto_frontal')
                ->label('Anverso')
                ->height(350)
                ->width(800)
                ->extraAttributes(['class' => 'text-center']),
                ImageEntry::make('foto_trasera')
                ->label('Reverso')
                ->height(350)
                ->width(800)
                ->extraAttributes(['class' => 'text-center']),
            ]),
              
        ]);
    }

    
    public static function table(Table $table): Table
    {
        return $table
            ->query(Billetes::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('denominacion')
                    ->label('Denominacion')
                    ->searchable()
                    ->sortable(),
                 CountryColumn::make('pais')
                    ->label('Pais')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->toggleable()
                    ->sortable(),
                ImageColumn::make('foto_frontal')->label('Anverso')->width(250)->height(100),
            ])
            ->filters([
                SelectFilter::make('pais')
                ->label('País')
                ->searchable()
                ->options([
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
            ]),  
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exports([
                        ExcelExport::make()
                            ->fromTable() // Obtiene todos los datos de la tabla
                            ->except([   // Excluye las columnas que contienen fotos
                                'foto_frontal', 
                                'foto_trasera'
                            ])
                    ])

            ])
            ->bulkActions([
                
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBilletes::route('/'),
            'create' => Pages\CreateBilletes::route('/create'),
            'edit' => Pages\EditBilletes::route('/{record}/edit'),
        ];
    }
}
