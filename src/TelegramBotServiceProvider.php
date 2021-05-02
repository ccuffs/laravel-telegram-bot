<?php

namespace CCUFFS\TelegramBot;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use CCUFFS\TelegramBot\Commands\TelegramBotCommand;

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
            ->hasConfigFile()
            ->hasMigration('create_laravel_telegram_bot_table')
            ->hasCommand(TelegramBotCommand::class);
    }
}
