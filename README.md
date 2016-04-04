# API Loja Integrada

[![Author](http://img.shields.io/badge/author-@wheraa-blue.svg?style=flat-square)](https://twitter.com/Wheraa)
[![Source Code](https://img.shields.io/badge/source-whera/LojaIntegrada-blue.svg?style=flat-square)](https://github.com/whera/LojaIntegrada/)
[![Latest Version](https://img.shields.io/github/release/whera/LojaIntegrada.svg?style=flat-square)](https://github.com/whera/LojaIntegrada/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/whera/LojaIntegrada/master.svg?style=flat-square)](https://travis-ci.org/whera/LojaIntegrada)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/whera/LojaIntegrada.svg?style=flat-square)](https://scrutinizer-ci.com/g/whera/LojaIntegrada/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/whera/LojaIntegrada.svg?style=flat-square)](https://scrutinizer-ci.com/g/whera/LojaIntegrada)
[![Total Downloads](https://img.shields.io/packagist/dt/wsw/loja-integrada.svg?style=flat-square)](https://packagist.org/packages/wsw/loja-integrada)

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
use WSW\LojaIntegrada\Client\LojaIntegradaException;

try {
 
    $credentials = new Credentials(
        '0a0000a0-aaa0-0000-a000-aa0a000000aa',
        '0a0000a0-aaa0-0000-a000-aa0a000000aB'
    );

    $category = new Category($credentials);

    // returns all records in the category
    $result = $category->findAll();
    
    // returns the related category to id
    $resultID = $category->find(123);
    
    // returns the categories related to the ids
    $resultIDs = $category->find([1, 10, 50, 99]);
    
    
    // returns the related category to the external id
    $resultIdExternal = $category->idExternal()->find(999);

} catch (LojaIntegradaException $e) {
    echo $e->getMessage();

} catch (\InvalidArgumentException $e) {
    echo $e->getMessage();
}

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

[link-author]: https://twitter.com/Wheraa
[link-contributors]: ../../contributors
