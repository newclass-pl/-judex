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


use Judex\Result;
use Judex\Validator\EmailValidator;

/**
 * Class EmailValidatorTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class EmailValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testValidateSuccess(){
        $validator=new EmailValidator();
        $resultMock=$this->getMockBuilder(Result::class)->getMock();
        $resultMock->expects($this->never())->method('addError');

        $validator->validate('test@newclass.pl',$resultMock);

    }

    /**
     *
     */
    public function testValidateFail(){
        $errorMessage=['Value is not valid format email.'];
        $validator=new EmailValidator();

        $result=new Result();
        $validator->validate('what@is@that.com',$result);

        $this->assertEquals($errorMessage,$result->getErrors());

        $result=new Result();
        $validator->validate('',$result);

        $this->assertEquals($errorMessage,$result->getErrors());

        $result=new Result();
        $validator->validate(null,$result);

        $this->assertEquals($errorMessage,$result->getErrors());
    }

    /**
     *
     */
    public function testCustomMessage(){
        $validator=new EmailValidator(['message'=>'Custom message.']);
        $result=new Result();

        $validator->validate(null,$result);

        $this->assertEquals(['Custom message.'],$result->getErrors());
    }

}