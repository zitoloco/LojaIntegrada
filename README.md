# API Loja Integrada

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

API integration with e-commerce system [Loja Integrada](https://lojaintegrada.com.br/)

## Install

Via Composer

``` bash
$ composer require wsw/loja-integrada
```

## Usage

``` php
use WSW\LojaIntegrada\Credentials;
use WSW\LojaIntegrada\Resources\Category;

$credentials = new Credentials(
    '0a0000a0-aaa0-0000-a000-aa0a000000aa',
    '0a0000a0-aaa0-0000-a000-aa0a000000aB'
);

$category = new Category($credentials);

// returns all records in the category
$result = $category->getAll();

// returns the related category to id
$resultID = $category->get(123);

// returns the categories related to the ids
$resultIDs = $category->get([1, 10, 50, 99]);


// returns the related category to the external id
$resultIdExternal = $category->idExternal()->find(999);


```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ronaldo@whera.com.br instead of using the issue tracker.

## Credits

- [Ronaldo M. Rodrigues][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/whera/LojaIntegrada.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/whera/LojaIntegrada/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/whera/LojaIntegrada.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/whera/LojaIntegrada.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/whera/LojaIntegrada.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/wsw/loja-integrada
[link-travis]: https://travis-ci.org/whera/LojaIntegrada
[link-scrutinizer]: https://scrutinizer-ci.com/g/whera/LojaIntegrada/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/whera/LojaIntegrada
[link-downloads]: https://packagist.org/packages/wsw/loja-integrada
[link-author]: https://github.com/whera
[link-contributors]: ../../contributors