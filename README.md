# bear/qatools

Collection of commonly used PHP QA tools.

Included in this package are:

* [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit) The PHP Unit Testing framework.
* [phpmd/phpmd](https://github.com/phpmd/phpmd) PHPMD is a spin-off project of PHP Depend and aims to be a PHP equivalent of the well known Java tool PMD.
* [squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) PHP_CodeSniffer tokenises PHP, JavaScript and CSS files and detects violations of a defined set of coding standards.
* [doctrine/coding-standard](https://github.com/doctrine/coding-standard) The PHP_CodeSniffer ruleset the bundled `BearSunday` standard builds on.
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

The `vendor/bear/qatools/` paths below assume the local install above. A global
install puts the package outside your project, so adjust the paths to wherever
`composer global config home` reports, or install locally. Note that a global
PHP_CodeSniffer standard is registered in the global `CodeSniffer.conf` only, so
a project-local `vendor/bin/phpcs` — what editors usually pick up — will not see
it.

**PHP_CodeSniffer** — `bear/qatools` registers itself as a standard named
`BearSunday`, so your `phpcs.xml` only needs to name it:

    <ruleset>
        <!-- The standard already defaults to 7.4; set this to the lowest PHP
             version you actually support. Without either, phpcs assumes the PHP
             it happens to be running on and results differ between CI legs. -->
        <config name="php_version" value="70400"/>

        <file>src</file>
        <file>tests</file>
        <!-- Matched against the whole absolute path, so keep them narrow:
             */tmp/* would also skip src/Tmp/, and skip everything if your
             checkout lives under /tmp. -->
        <exclude-pattern>*/tests/Fake/*</exclude-pattern>
        <exclude-pattern>*/tests/tmp/*</exclude-pattern>

        <rule ref="BearSunday"/>
    </ruleset>

This minimal example reports warnings as well as errors. The `phpcs.xml` template
below adds `<arg value="nps"/>`, which suppresses warnings, shows progress and
names the sniff behind each report — the one reason the two can differ in output
while using the same standard.

Registration happens through `dealerdirect/phpcodesniffer-composer-installer`,
which Composer only runs if your project allows it:

    composer config allow-plugins.dealerdirect/phpcodesniffer-composer-installer true

Without that, `composer install` either fails outright with a blocked-plugin
error, or — if the plugin is allowed nowhere and explicitly denied — installs
quietly and leaves `phpcs` reporting `Referenced sniff "BearSunday" does not
exist`. Standard names are global across every installed standard, with no
namespacing — `phpcs -e --standard=BearSunday` lists what the name actually
resolved to.

**PHPStan** — include the shared settings and add your own paths:

    includes:
        - vendor/bear/qatools/phpstan-base.neon

    parameters:
        paths:
            - src
            - tests

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

    phpmd src text vendor/bear/qatools/phpmd.xml

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
