# bear/qatools

Collection of commonly used PHP QA tools.

Included in this package are:

* [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit) The PHP Unit Testing framework.
* [phpmd/phpmd](https://github.com/phpmd/phpmd) PHPMD is a spin-off project of PHP Depend and aims to be a PHP equivalent of the well known Java tool PMD.
* [squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) PHP_CodeSniffer tokenises PHP, JavaScript and CSS files and detects violations of a defined set of coding standards.
* [doctrine/coding-standard](https://github.com/doctrine/coding-standard) The PHP_CodeSniffer ruleset the bundled `phpcs.xml` builds on.
* [phpstan/phpstan](https://github.com/phpstan/phpstan) A PHP Static Analysis Tool.
* [vimeo/psalm](https://psalm.dev/) A static analysis tool for PHP.
* [phpmetrics/phpmetrics](http://www.phpmetrics.org/) Static analysis tool for PHP.

# Installation

Global install

    composer global require bear/qatools

Local install

    composer require --dev bear/qatools

## QA Configs

PHP_CodeSniffer, PHPStan and PHPMD are configured by reference rather than by
copying, so fixes to the shared rules reach your project with `composer update`.

**PHP_CodeSniffer** — `bear/qatools` registers itself as a standard named
`BearSunday`, so your `phpcs.xml` only needs to name it:

```xml
<ruleset>
    <file>src</file>
    <file>tests</file>

    <rule ref="BearSunday"/>
</ruleset>
```

**PHPStan** — include the shared settings and add your own paths:

```neon
includes:
    - vendor/bear/qatools/phpstan-base.neon

parameters:
    paths:
        - src
        - tests
```

**PHPMD** — point at the shipped ruleset directly, no local file needed:

    phpmd src text vendor/bear/qatools/phpmd.xml

Ready-made versions of the first two are in the package root if you would rather
start from a copy than write your own:

    cp vendor/bear/qatools/phpcs.xml .
    cp vendor/bear/qatools/phpstan.neon .

**Psalm** — copy-based; Psalm has no mechanism for including an external config:

    cp vendor/bear/qatools/psalm.xml .

For PHPUnit, copy the template matching your PHPUnit major version:

    # PHPUnit 9
    cp vendor/bear/qatools/phpunit.xml.dist phpunit.xml

    # PHPUnit 10, 11 or 12
    cp vendor/bear/qatools/phpunit10.xml.dist phpunit.xml

PHPUnit 10 replaced the configuration schema, and the two are not interchangeable —
`phpunit.xml.dist` triggers a deprecation notice on PHPUnit 10 and later, while
`phpunit10.xml.dist` is rejected by PHPUnit 9. PHPUnit 9 remains supported because
PHPUnit 10, 11 and 12 require PHP 8.1, 8.2 and 8.3 respectively, so it is the only
line installable on PHP 7.4 and 8.0.

## CI Configs

    cp vendor/bear/qatools/.scrutinizer.yml .

* [phpunit.xml](https://phpunit.de/manual/current/en/index.html)
* [phpcs.xml](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-ruleset.xml)
* [phpmd.xml](https://phpmd.org/documentation/creating-a-ruleset.html)
* [.scrutinizer.yml](https://scrutinizer-ci.com/docs/guides/php/)

# Usage

## Composer Scripts

Composer does not inherit scripts from dependencies, so copy the `scripts` block from
`vendor/bear/qatools/composer.json` into your own `composer.json` to get these:

    composer tests      # Run cs, sa, and test in sequence
    composer test       # Run PHPUnit tests
    composer cs         # Run PHP_CodeSniffer
    composer cs-fix     # Auto-fix coding standard violations with phpcbf
    composer sa         # Run all static analysis (phpstan, psalm, phpmd)
    composer coverage   # Generate test coverage report
    composer metrics    # Generate PHPMetrics HTML report

## Direct Commands

phpunit

    phpunit

phpcs

    phpcs --standard=./phpcs.xml src

phpstan

    phpstan analyse -c phpstan.neon

psalm

    psalm

phpmd

    phpmd src text ./phpmd.xml

phpmetrics

    phpmetrics --report-html=build/metrics src

# Code Standards

* PSR-12 base with Doctrine Coding Standard
* PHPStan level: max, over `src` and `tests`
* Psalm errorLevel: 1, over `src` only
* PHP compatibility: 7.4+

Psalm is deliberately kept off `tests`: errorLevel 1 is too strict for test code,
where rules such as `ClassMustBeFinal` work against normal PHPUnit practice.
`UnusedClass` is suppressed as a consequence — with only `src` analysed, a class
reached through the framework or used only from tests looks unused. Test code is
still covered by `phpcs` and PHPStan.
