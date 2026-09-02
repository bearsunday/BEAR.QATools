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

    cp vendor/bear/qatools/phpcs.xml .
    cp vendor/bear/qatools/phpmd.xml .
    cp vendor/bear/qatools/phpstan.neon .
    psalm --init

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
* PHPStan level: max
* Psalm errorLevel: 1
* PHP compatibility: 7.4+
