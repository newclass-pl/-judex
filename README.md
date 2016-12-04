README
======

![license](https://img.shields.io/packagist/l/bafs/via.svg?style=flat-square)
![PHP 5.5+](https://img.shields.io/badge/PHP-5.5+-brightgreen.svg?style=flat-square)

What is Judex?
-----------------

Judex is a PHP validator.

Installation
------------

The best way to install is to use the composer by command:

composer require newclass/judex

composer install

Use example
------------

    use Judex\Validator\EmailValidator;
    use Judex\Validator\NotEmptyValidator;
    use Judex\ValidatorManager;

    $validator=new ValidatorManager();
    $validator->add(new EmailValidator());
    $validator->add(new NotEmptyValidator());

    $result=$validator->validate('test@newclass.pl');
    $valid=$result->isValid(); //return true

    $result=$validator->validate('test.newclass.pl');
    $valid=$result->isValid(); //return false
    $errors=$result->getErrors(); //return ['Value is not valid format email.']

    $result=$validator->validate('');
    $valid=$result->isValid(); //return false
    $errors=$result->getErrors(); //return ['Value can\'t be empty.']
