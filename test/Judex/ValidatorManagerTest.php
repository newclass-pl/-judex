<?php
/**
 * Judex: Validator
 * Copyright (c) NewClass (http://newclass.pl)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the file LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) NewClass (http://newclass.pl)
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


namespace Test\Judex;


use Judex\Validator\EmailValidator;
use Judex\Validator\NotEmptyValidator;
use Judex\ValidatorManager;
use Judex\ValidatorNotFoundException;

/**
 * Class ValidatorManagerTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class ValidatorManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testValidateEmpty()
    {
        $validator = new ValidatorManager();
        $validator->addValidator(new EmailValidator());

        $result = $validator->validate('test@newclass.pl');
        $this->assertTrue($result->isValid());

        $result = $validator->validate('');
        $this->assertTrue($result->isValid());

        $result = $validator->validate('invalid');
        $this->assertFalse($result->isValid());
        $this->assertCount(1, $result->getErrors());
        $this->assertEquals('Value is not valid format email.', $result->getErrors()[0]);

    }

    /**
     *
     */
    public function testValidateNotEmpty()
    {
        $validator = new ValidatorManager();
        $validator->addValidator(new EmailValidator());
        $validator->addValidator(new NotEmptyValidator());

        $result = $validator->validate('test@newclass.pl');
        $this->assertTrue($result->isValid());

        $result = $validator->validate('');
        $this->assertFalse($result->isValid());
        $this->assertCount(1, $result->getErrors());
        $this->assertEquals('Value can\'t be empty.', $result->getErrors()[0]);

        $result = $validator->validate('invalid');
        $this->assertFalse($result->isValid());
        $this->assertCount(1, $result->getErrors());
        $this->assertEquals('Value is not valid format email.', $result->getErrors()[0]);

    }

    /**
     *
     */
    public function testGetterSetter()
    {
        $validatorManager = new ValidatorManager();
        $validator = new EmailValidator();
        $validatorManager->addValidator($validator);
        $validatorManager->addValidator(new NotEmptyValidator());


        $this->assertCount(2, $validatorManager->getValidators());
        $this->assertEquals($validator,$validatorManager->getValidator(EmailValidator::class));

        $validatorManager->removeValidator(EmailValidator::class);
        $this->assertCount(1, $validatorManager->getValidators());

        $this->expectException(ValidatorNotFoundException::class);
        $validatorManager->getValidator(EmailValidator::class);
        $validatorManager->removeValidator(EmailValidator::class);

    }

}