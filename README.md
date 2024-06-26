## Better Typo
*Better Typography for your Kirby Site*

“Better Typo” is a Kirby plugin tailored for enhancing typography especially for client-submitted content. It automatically transforms [dumb quotes](https://smartquotesforsmartpeople.com/) (`""`/`''`) into smart quotes, straight apostrophes (`'`) into their curved equivalents and lots more. Automation in typography ensures consistency and professionalism without requiring manual intervention from designers.

## Installation

The first option is to simply drag the `better-typo` folder inside your `site/plugins` folder.

The second option is to install “Better Typo” directly through the command line via Composer:

```terminal
composer require simonlou/better-typo
```

## How to Use

Just add a `->bettertypo()` or `->bt()` to your chain which inputs the text you want to enhance.

For example:

```php
$page->text()->bettertypo()
```

or

```php
$page->text()->bt()
```

## Language Configuration

“Better Typo” is currently available for English and German. In your `site/config/config.php` file you can specify which language you want to use (`en` or `de`). English is the default if you don’t add anything in your config.
It's really important to choose the right language because the corrections are different.

```php
return [
    'simonlou.better-typo.language' => 'de',
];
```

## Features

- [x] Fixes double quotes: `""` → `“”` (localized)
- [x] Fixes single quotes: `''` → `‘’` (localized)
- [x] Fixes guillemets facing the wrong direction: `« … »` → `» … «` (German)
- [x] Fixes apostrophes: `'` → `’`
- [x] Fixes hyphens that are used as en dashes: `… - …` → `… – …`
- [x] Fixes wrong multiplication signs: `X`/`x` → `×`
- [x] Adds thin space between number and unit: `1m`/`1 m` → `1 m`
- [x] Adds thin spaces before and after slash: `/`/` / ` → ` / `
- [x] Fixes ellipsis: `...` → `‌…`

## To Do

- [ ] Handle special cases like ’90s, ’Twas, Rock ’n’ Roll, etc.
- [ ] If there is only one dumb single quote in a string, it’s probably an apostrophe
- [ ] Track open/closed state while iterating over the text to make more informed decisions
- [ ] Handle double primes for inch
- [ ] Add non-breaking spaces

## Credits

“Better Typo” is developed by [Simon Lou](https://simonlou.com) ([@simonlou@typo.social](https://typo.social/@simonlou)).

Thanks to [Frank Rausch](https://frankrausch.com) ([@frankrausch@mastodon.social](https://mastodon.social/@frankrausch) for the inspiration, he did a similar project for swift a few years back.

## License

The “Better Typo” source code is released under the MIT License. Please view the LICENSE file for details.
