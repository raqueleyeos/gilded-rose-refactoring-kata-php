# GildedRose Kata - PHP Version

See the [top level readme](./GildedRoseRequirements_es.md) for general information about this exercise. This is the PHP version of the
 GildedRose Kata. 

## Installation

The kata uses:

- docker
- PHP 7.2+
- [Composer](https://getcomposer.org)

Recommended:

Install all the dependencies using Makefile

```shell script
make install
```

## Dependencies

The project uses composer to install:

- [PHPUnit](https://phpunit.de/)
- [PHPStan](https://github.com/phpstan/phpstan)

## Folders

- `src` - contains the two classes:
  - `Item.php` - this class should not be changed.
  - `GildedRose.php` - this class needs to be refactored, and the new feature added.
- `tests` - contains the tests
  - `GildedRoseTest.php` - Starter test.
  - `ApprovalTest.php` - alternative approval test (set to 30 days)

## Testing

PHPUnit is pre-configured to run tests. PHPUnit can be run using a composer script. To run the unit tests, from the
 root of the PHP project run:

```shell script
make test
```

### Tests with Coverage Report

To run all test and generate a html coverage report run:

```shell script
make test-coverage-html
```
The test-coverage report will be created in /builds, it is best viewed by opening **index.html** in your browser.
 
To run all test and generate a text coverage report run:

```shell script
make test-coverage-text
```

## Static Analysis

PHPStan is used to run static analysis checks:

```shell script
make phpstan
```

**Happy coding**!