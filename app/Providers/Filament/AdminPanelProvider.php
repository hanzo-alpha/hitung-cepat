<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\QuickCountInfo;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
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
use Jeffgreco13\FilamentBreezy\BreezyCore;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Shipu\WebInstaller\Middleware\RedirectIfNotInstalled;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
//            ->topNavigation()
            ->default()
            ->spa()
            ->id('admin')
            ->path('')
            ->login()
            ->profile()
            ->passwordReset()
            ->darkMode(false)
            ->font('Poppins')
            ->databaseNotifications()
//            ->databaseNotificationsPolling('30s')
            ->plugins([
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                        shouldRegisterNavigation: false,
                        // Adds a main navigation item for the My Profile page (default = false)
                        hasAvatars: false, // Enables the avatar upload form component (default = false)
                        slug: 'profil' // Sets the slug for the profile page (default = 'my-profile')
                    ),
                SpotlightPlugin::make(),
                FilamentShieldPlugin::make(),
                //                CuratorPlugin::make()
                //                    ->label('Media')
                //                    ->pluralLabel('Media')
                //                    ->navigationIcon('heroicon-o-photo')
                //                    ->navigationGroup('Master')
                //                    ->navigationSort(3)
                //                    ->navigationCountBadge(),
            ])
            ->colors([
                'primary' => Color::Blue,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Tim Relawan')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Master')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Pengaturan')
                    ->collapsed(true),
            ])
            ->favicon(asset('images/favicon.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                QuickCountInfo::class,
            ])
            ->navigationGroups([
                NavigationGroup::make('Tim Relawan')
                    ->icon('heroicon-o-users'),
                NavigationGroup::make('Master')
                    ->icon('heroicon-o-circle-stack'),
                NavigationGroup::make('Tools')
                    ->icon('heroicon-o-cog-6-tooth'),
                NavigationGroup::make('Pengaturan'),
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
                RedirectIfNotInstalled::class,
            ])
            ->resources([
                config('filament-logger.activity_resource'),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->viteTheme('resources/css/filament/admin/theme.css');
    }
}
