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
use Judex\Validator\RegExValidator;

/**
 * Class RegExValidatorTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class RegExValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testValidateSuccess(){
        $validator=new RegExValidator('message: \d{1}');
        $resultMock=$this->getMockBuilder(Result::class)->getMock();
        $resultMock->expects($this->never())->method('addError');

        $validator->validate('message: 5',$resultMock);
        $validator->validate('message: 1',$resultMock);

    }

    /**
     *
     */
    public function testValidateFail(){
        $errorMessage=['Value is not validated by pattern.'];
        $validator=new RegExValidator('message: \d{1}');

        $result=new Result();
        $validator->validate('unknown',$result);

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
        $validator=new RegExValidator('message: \d{1}','Custom message.');
        $result=new Result();

        $validator->validate('unknown',$result);

        $this->assertEquals(['Custom message.'],$result->getErrors());
    }

}