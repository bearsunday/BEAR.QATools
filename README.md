# bear/qatools

Collection of commonly used php QA tools.

Included in this package are:

* [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit) The PHP Unit Testing framework.
* [phploc/phploc](https://github.com/sebastianbergmann/phploc) A tool for quickly measuring the size of a PHP project.
* [phpmd/phpmd](https://github.com/phpmd/phpmd) PHPMD is a spin-off project of PHP Depend and aims to be a PHP equivalent of the well known Java tool PMD.
* [squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) PHP_CodeSniffer tokenises PHP, JavaScript and CSS files and detects violations of a defined set of coding standards.
* [sebastian/phpcpd](https://github.com/sebastianbergmann/phpcpd) Copy/Paste Detector (CPD) for PHP code.
* [sensiolabs/security-checker](https://github.com/sensiolabs/security-checker) PHP frontend for security.symfony.com.
* [phpstan/phpstan](https://github.com/phpstan/phpstan) A PHP Static Analysis Tool.
* [vimeo/psalm](https://getpsalm.org/) A static analysis tool for PHP.
* [phpmetrics/phpmetrics](http://www.phpmetrics.org/) Static analysis tool for PHP.

# Installation

Global install

    composer global require bear/qatools

Local install

    composer require --dev bear/qatools

# QA Configs

    cp vendor/bear/qatools/phpunit.xml.dist phpunit.xml
    cp vendor/bear/qatools/phpcs.xml .
    cp vendor/bear/qatools/phpmd.xml .
    cp vendor/bear/qatools/phpstan.neon .
    psalm --init

## CI Configs

    cp vendor/bear/qatools/.travis.yml .
    cp vendor/bear/qatools/.scrutinizer.yml .

* [phpunit.xml](https://phpunit.de/manual/current/en/index.html)
* [phpcs.xml](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-ruleset.xml)
* [phpmd.xml](https://phpmd.org/documentation/creating-a-ruleset.html)
* [phpunit.xml](https://phpunit.de/manual/current/en/index.html)
* [.php_cs](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
* [.travis.yml](https://docs.travis-ci.com/user/customizing-the-build)
* [.scrutinizer.yml](https://scrutinizer-ci.com/docs/guides/php/)

# Usage

### All

`phpcs`, `phpmd`, `phpunit`,  `php-cs-fixer`, `pdepend`, `phploc`, and `php-cs-fixer` will be executed in order. This is the ideal for CI.

global

```
~/.composer/vendor/bin/phpbuild
```

local

```
./vendor/bin/phpbuild
```

# Individual execution

### development

phpunit

    phpunit

phpunit + phpmd + phpcs + php-cs-fixer + phpstan + psalm

    phptest

### per commit

php-cs-fixer

    php-cs-fixer fix src

phpcs

    phpcs --standard=./phpcs.xml src
    phpcs --standard=./phpcs.xml --warning-severity=false src
    phpcs --standard=vendor/bear/qatools/phpcs.xml --warning-severity=false src

### per deploy

security-checker

    security-checker security:check

### code quality

phpstan

    phpstan analyse

psalm

    psalm

phploc

    phploc src
    
phpcpd    

    phpcpd src

phpmetrics

    phpmetrics --report-html=build/metrics/ --extensions=php src,composer.json,composer.lock --junit=build/logs/junit.xml
