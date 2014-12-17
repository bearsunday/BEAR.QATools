# bear/qatools

Collection of commonly used php QA tools.

Included in this package are:

* [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit) The PHP Unit Testing framework.
* [phploc/phploc] (https://github.com/sebastianbergmann/phploc) A tool for quickly measuring the size of a PHP project.
* [phpmd/phpmd](https://github.com/phpmd/phpmd) PHPMD is a spin-off project of PHP Depend and aims to be a PHP equivalent of the well known Java tool PMD
* [squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) PHP_CodeSniffer tokenises PHP, JavaScript and CSS files and detects violations of a defined set of coding standards.
* [fabpot/php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) Analyzes some PHP source code and tries to fix coding standards issues (PSR-1 and PSR-2 compatible)
* [sebastian/phpcpd](https://github.com/sebastianbergmann/phpcpd) Copy/Paste Detector (CPD) for PHP code.
* [covex-nn/phpcb](https://github.com/covex-nn/PHP_CodeBrowser) A code browser that augments the code with information from various QA tools.
* [apigen/apigen](https://github.com/apigen/apigen) PHP source code API generator
* [sensiolabs/security-checker](https://github.com/sensiolabs/security-checker) PHP frontend for security.sensiolabs.org

# Installation

## global

    $ composer global require bear/qatools phpmd/phpmd:@dev apigen/apigen:@dev

## local

To use this package, add it as as "dev" dependency with this command:

    $ composer require bear/qatools phpmd/phpmd:@dev apigen/apigen:@dev --dev

More info about development dependencies: http://getcomposer.org/doc/04-schema.md#require-dev

** @dev are requited for phpmd and apigen to fix recent issues.
