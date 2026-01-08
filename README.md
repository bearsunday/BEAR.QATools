# bear/qatools

Collection of commonly used PHP QA tools.

Included in this package are:

* [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit) The PHP Unit Testing framework.
* [phpmd/phpmd](https://github.com/phpmd/phpmd) PHPMD is a spin-off project of PHP Depend and aims to be a PHP equivalent of the well known Java tool PMD.
* [squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) PHP_CodeSniffer tokenises PHP, JavaScript and CSS files and detects violations of a defined set of coding standards.
* [friendsofphp/php-cs-fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) A tool to automatically fix PHP Coding Standards issues.
* [phpstan/phpstan](https://github.com/phpstan/phpstan) A PHP Static Analysis Tool.
* [vimeo/psalm](https://psalm.dev/) A static analysis tool for PHP.
* [phpmetrics/phpmetrics](http://www.phpmetrics.org/) Static analysis tool for PHP.

# Installation

Global install

    composer global require bear/qatools

Local install

    composer require --dev bear/qatools

## QA Configs

    cp vendor/bear/qatools/phpunit.xml.dist phpunit.xml
    cp vendor/bear/qatools/phpcs.xml .
    cp vendor/bear/qatools/phpmd.xml .
    cp vendor/bear/qatools/phpstan.neon .
    psalm --init

## CI Configs

    cp vendor/bear/qatools/.scrutinizer.yml .

* [phpunit.xml](https://phpunit.de/manual/current/en/index.html)
* [phpcs.xml](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-ruleset.xml)
* [phpmd.xml](https://phpmd.org/documentation/creating-a-ruleset.html)
* [.php_cs.dist](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)
* [.scrutinizer.yml](https://scrutinizer-ci.com/docs/guides/php/)

# Usage

## Composer Scripts

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
