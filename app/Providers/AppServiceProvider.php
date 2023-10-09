<?php

namespace App\Providers;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sending validation notification on all pages
        Page::$reportValidationErrorUsing = static function (ValidationException $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->sendToDatabase(auth()->user());
        };
    }
}
