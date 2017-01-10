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
use Judex\Validator\NotEmptyValidator;

/**
 * Class NotEmptyValidatorTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class NotEmptyValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testValidateSuccess(){
        $validator=new NotEmptyValidator();
        $resultMock=$this->getMockBuilder(Result::class)->getMock();
        $resultMock->expects($this->never())->method('addError');

        $validator->validate('any',$resultMock);
        $validator->validate(true,$resultMock);
        $validator->validate(213.32,$resultMock);

    }

    /**
     *
     */
    public function testValidateFail(){
        $errorMessage=['Value can\'t be empty.'];
        $validator=new NotEmptyValidator();

        $result=new Result();
        $validator->validate('',$result);

        $this->assertEquals($errorMessage,$result->getErrors());

        $result=new Result();
        $validator->validate(null,$result);

        $this->assertEquals($errorMessage,$result->getErrors());

        $result=new Result();
        $validator->validate([],$result);

        $this->assertEquals($errorMessage,$result->getErrors());
    }

    /**
     *
     */
    public function testCustomMessage(){
        $validator=new NotEmptyValidator(['message'=>'Custom message.']);
        $result=new Result();

        $validator->validate(null,$result);

        $this->assertEquals(['Custom message.'],$result->getErrors());
    }

}