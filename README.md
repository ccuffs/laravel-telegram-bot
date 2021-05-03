<p align="center">
    <img width="800" src=".github/logo.png" title="Project logo"><br />
    <img src="https://img.shields.io/maintenance/yes/2021?style=for-the-badge" title="Project status">
    <img src="https://img.shields.io/github/workflow/status/ccuffs/template-english/ci.uffs.cc?label=Build&logo=github&logoColor=white&style=for-the-badge" title="Build status">
    <img src="https://img.shields.io/packagist/v/ccuffs/laravel-telegram-bot.svg?style=flat-square" title="Latest Version on Packagist">
</p>

# Laravel-telegram-bot

Project description goes here. This description is usually two to three lines long. It should give an overview of what the project is, eg technology used, philosophy of existence, what problem it is trying to solve, etc. If you need to write more than 3 lines of description, create subsections.

> ** NOTICE: ** put here a message that is very relevant to users of the project, if any.

## ✨Features

Here you can place screenshots of the project. Also describe your features using a list:

* Easy integration;
* Few dependencies;
* Beautiful template-english with a nice `README`;
* Great documentation and testing?

## 🚀 Getting started

### Installation

You can install the package via composer:

```bash
composer require ccuffs/laravel-telegram-bot
```

Publish config and migrations:

```bash
php artisan vendor:publish --provider="CCUFFS\TelegramBot\TelegramBotServiceProvider"
```

Run the migrations:

```bash
php artisan migrate
```

### Usage

```php
$bot = new CCUFFS\TelegramBot();
echo $bot->echoPhrase('Hello, Spatie!');
```

#### Configuration

This is the contents of the published config file:

```php
return [
];
```


### Testing

```bash
composer test
```

```bash
 curl -v -k -X POST -H "Content-Type: application/json" -H "Cache-Control: no-cache" --data @message-with-text.json "http://localhost.dev/ccuffs/bot/telegram"
```

## 🤝 Contribute

Your help is most welcome regardless of form! Check out the [CONTRIBUTING.md](CONTRIBUTING.md) file for all ways you can contribute to the project. For example, [suggest a new feature](https://github.com/ccuffs/template-english/issues/new?assignees=&labels=&template-english=feature_request.md&title=), [report a problem/bug](https://github.com/ccuffs/template-english/issues/new?assignees=&labels=bug&template-english=bug_report.md&title=), [submit a pull request](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/about-pull-requests), or simply use the project and comment your experience. You are encourage to participate as much as possible, but stay tuned to the [code of conduct](./CODE_OF_CONDUCT.md) before making any interaction with other community members.

See the [ROADMAP.md](ROADMAP.md) file for an idea of how the project should evolve.

## 🎫 License

This project is licensed under the [MIT](https://choosealicense.com/licenses/mit/) open-source license and is available for free.

## 🧬 Changelog

See all changes to this project in the [CHANGELOG.md](CHANGELOG.md) file.

## 🧪 Similar projects

Below is a list of interesting links and similar projects:

* [Other project](https://github.com/project)
* [Project inspiration](https://github.com/project)
* [Similar tool](https://github.com/project)
