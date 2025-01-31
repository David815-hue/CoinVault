<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Awcodes\LightSwitch\LightSwitchPlugin;
use App\Filament\Widgets\MapBilletes;
use App\Filament\Widgets\MapWidget;
use App\Filament\Widgets\SecondMapWidget;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin') //admin
            ->path('admin') //admin
            ->sidebarCollapsibleOnDesktop()
            ->brandName("ANH")
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                MapWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
               \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
               \App\Http\Middleware\CheckIfUserIsActive::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                LightSwitchPlugin::make(),
                 \Hasnayeen\Themes\ThemesPlugin::make(),
                 FilamentBackgroundsPlugin::make()
                ->imageProvider(
                    MyImages::make()
                        ->directory('images/backgrounds')
                ),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                FilamentSpatieLaravelBackupPlugin::make(),
                FilamentEditProfilePlugin::make()
                    ->slug('my-profile')
                    ->setTitle('Editar Perfil')
                    ->setNavigationLabel('Perfil')
                    ->setNavigationGroup('Editar Perfil')
                    ->setIcon('heroicon-o-user')
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowBrowserSessionsForm(false)
                

            ]);
    }
}
