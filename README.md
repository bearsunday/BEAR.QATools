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


Global install

    composer global require bear/qatools

Local install

    composer require bear/qatools

# Place config files

    cp vendor/bear/qatools/phpunit.xml.dist phpunit.xml 
    cp vendor/bear/qatools/phpcs.xml .
    cp vendor/bear/qatools/phpmd.xml .
    cp vendor/bear/qatools/.php_cs.dist .php_cs

# Usage

### All
`phpcs`, `phpmd`, `phpunit`,  `php-cs-fixer`, `pdepend`, `phploc`, `apigen` and `php-cs-fixer` will be executed in order. This is the ideal for CI.

    vendor/bin/phpbuild

Since `php-cs-fixer` only issues a warning, please modify the code with `php-cs-fixer fix src` command if necessary.

    
# Individual execution

    
### development

phpunit

    vendor/bin/phpunit

### per commit

php-cs-fixer

    vendor/bin/php-cs-fixer fix src

phpcs

    vendor/bin/phpcs --standard=./phpcs.xml src
    vendor/bin/phpcs --standard=./phpcs.xml --warning-severity=false src
    vendor/bin/phpcs --standard=vendor/bear/qatools/phpcs.xml --warning-severity=false src
    
### per deploy

security-checker

    vendor/bin/security-checker security:check

### code quality

phploc

    vendor/bin/phploc src
    
phpcpd    

    vendor/bin/phpcpd src

### documentation

apigen

    vendor/bin/apigen generate -s src -d build/api
    
phpcb

    vendor/bin/phpcb -s src -o build/code-browser

