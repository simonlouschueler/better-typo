## Better Typo
*Better Typography for your Kirby Site*

“Better Typo” is a Kirby plugin tailored for enhancing typography especially for client-submitted content. It automatically transforms [dumb quotes](https://smartquotesforsmartpeople.com/) (`""`/`''`) into smart quotes, straight apostrophes (`'`) into their curved equivalents and lots more. Automation in typography ensures consistency and professionalism without requiring manual intervention from designers.

## Installation

Simply put the `better-typo-en` or the `better-typo-de` (depending on the language you want to correct) inside you `site/plugins` folder.

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

## Features

- [x] Fixes double quotes: `""` → `“”` (localized)
- [x] Fixes single quotes: `''` → `‘’` (localized)
- [x] Fixes guillemets facing the wrong direction: `« … »` → `» … «` (German)
- [x] Fixes apostrophes: `'` → `’`
- [x] Fixes hyphens that are used as en dashes: `… - …` → `… – …`
- [x] Fixes wrong multiplication signs: `X`/`x` → `×`

## To Do

- [ ] Handle special cases like ’90s, ’Twas, Rock ’n’ Roll, etc.
- [ ] If there is only one dumb single quote in a string, it’s probably an apostrophe
- [ ] Track open/closed state while iterating over the text to make more informed decisions
- [ ] Add thin spaces or even non-breaking thin spaces between value and unit (e.g. 1 m)
- [ ] Handle double primes for inch
- [ ] Hair spaces before and after `/`

## Credits

“Better Typo” is developed by [Simon Lou](https://simonlou.com) ([@simonlou@typo.social](https://typo.social/@simonlou)).

Thanks to [Frank Rausch](https://frankrausch.com) ([@frankrausch@mastodon.social](https://mastodon.social/@frankrausch) for the inspiration, he did a similar project for swift a few years back.

## License

The “Better Typo” source code is released under the MIT License. Please view the LICENSE file for details.
