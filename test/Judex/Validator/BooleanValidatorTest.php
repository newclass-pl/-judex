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
use Judex\Validator\BooleanValidator;

class BooleanValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testValidateSuccess(){
        $validator=new BooleanValidator();
        $resultMock=$this->getMockBuilder(Result::class)->getMock();
        $resultMock->expects($this->never())->method('addError');

        $validator->validate(true,$resultMock);
        $validator->validate(false,$resultMock);

    }

    public function testValidateFail(){
        $validator=new BooleanValidator();
        $result=new Result();

        $validator->validate(null,$result);

        $this->assertEquals(['Value is not boolean.'],$result->getErrors());
    }

    public function testCustomMessage(){
        $validator=new BooleanValidator('Custom message.');
        $result=new Result();

        $validator->validate(null,$result);

        $this->assertEquals(['Custom message.'],$result->getErrors());
    }

}