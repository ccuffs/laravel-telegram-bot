<?php

namespace CCUFFS\TelegramBot;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use CCUFFS\TelegramBot\Commands\TelegramBotSetupCommand;

class TelegramBotServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-telegram-bot')
            ->hasConfigFile('telegrambot')
            ->hasMigration('create_telegram_bot_table')
            ->hasRoutes(['web'])
            ->hasCommands([
                TelegramBotSetupCommand::class
            ]);
    }
}
