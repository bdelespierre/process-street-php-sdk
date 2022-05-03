# ProcessStreet PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Unofficial [Process Street][link-process-street] PHP SDK.

## Install

Via Composer

``` bash
$ composer require bdelespierre/process-street-php-sdk
```

## Usage

``` php
$event = ProcessStreet\Models\Payload::from(
    json_decode(file_get_contents('php://input'), true)
);

echo $event->checklist->template->name; // e.g. Test Workflow
```

Please see [HOWTO](demo/HOWTO.md) for a detailed installation procedure of a testing environment.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email benjamin.delespierre@gmail.com instead of using the issue tracker.

## Credits

- [Benjamin Delespierre][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/bdelespierre/process-street-php-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/bdelespierre/process-street-php-sdk/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/bdelespierre/process-street-php-sdk.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/bdelespierre/process-street-php-sdk.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/bdelespierre/process-street-php-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/bdelespierre/process-street-php-sdk
[link-travis]: https://travis-ci.org/bdelespierre/process-street-php-sdk
[link-scrutinizer]: https://scrutinizer-ci.com/g/bdelespierre/process-street-php-sdk/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/bdelespierre/process-street-php-sdk
[link-downloads]: https://packagist.org/packages/bdelespierre/process-street-php-sdk
[link-author]: https://github.com/bdelespierre
[link-contributors]: ../../contributors
[link-process-street]: https://www.process.st/
