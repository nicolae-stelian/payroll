Payroll Case Study
==================

This is my implementation of the Payroll Case Study from the book Agile Software
Development by Robert C. Martin (a.k.a. Uncle Bob).

Implementation details
----------------------

It's written in Php, using PHPUnit 4.3.1 for unit testing, Composer for dependency management, 
Phpcs for style verification, Ant for automatic build, Phpcpd for copy paste detector, 
Phpmd for mess detector. 

 For install this tools:
 
 ```
 apt-get install ant
 
 wget https://phar.phpunit.de/phpunit.phar -o ~/bin/phpcs.phar
 curl -sS https://getcomposer.org/installer | php -- --install-dir=~/bin 
 wget https://github.com/squizlabs/PHP_CodeSniffer/releases/download/2.0.0a2/phpcs.phar -o ~/bin/phpcs.phar
 wget https://phar.phpunit.de/phpcpd.phar -o ~/bin/phpcpd.phar
 wget http://static.phpmd.org/php/2.1.3/phpmd.phar  -o ~/bin/phpcpd.phar
 
 chmod +x ~/bin/*.phar
  ```
 
 For automatic build, use:
   ```
   ant build
   ```