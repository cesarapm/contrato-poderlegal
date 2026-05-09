<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Poder Legal')
            ->favicon(asset('images/favicon.png'))
            ->colors([
                'primary' => [
                    50 => '#f9f6ff',
                    100 => '#f2ebff',
                    200 => '#e4d4ff',
                    300 => '#d1b3ff',
                    400 => '#b380ff',
                    500 => '#9C27B0',  // light-purple
                    600 => '#663399',  // primary-purple
                    700 => '#4A148C',  // purple-bishop (DEFAULT)
                    800 => '#311B92',  // dark-purple
                    900 => '#1A0933',  // purple-deep
                    950 => '#0d0419',
                ],
                'secondary' => [
                    50 => '#fffef0',
                    100 => '#fffbd6',
                    200 => '#fff6ad',
                    300 => '#ffed7a',
                    400 => '#ffdc3f',
                    500 => '#FFD700',  // primary-gold (DEFAULT)
                    600 => '#FFC107',  // gold-accent
                    700 => '#FFAA00',  // gold-warm
                    800 => '#cc8800',
                    900 => '#996600',
                    950 => '#664400',
                ],
                'success' => Color::Green,
                'warning' => Color::Orange,
                'danger' => Color::Red,
            ])
            ->font('Inter')
            ->maxContentWidth('full')
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
