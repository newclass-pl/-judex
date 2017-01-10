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
use Judex\Validator\DateValidator;

/**
 * Class DateValidatorTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class DateValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testValidateSuccess(){
        $validator=new DateValidator();
        $resultMock=$this->getMockBuilder(Result::class)->getMock();
        $resultMock->expects($this->never())->method('addError');

        $validator->validate('2012-01-03',$resultMock);

    }

    /**
     *
     */
    public function testValidateFail(){
        $validator=new DateValidator();

        $result=new Result();
        $validator->validate('12-05-2016',$result);

        $this->assertEquals(['Value is not valid format date YYYY-MM-DD.'],$result->getErrors());

        $result=new Result();
        $validator->validate('2016-30-12',$result);

        $this->assertEquals(['Value is not valid format date YYYY-MM-DD.'],$result->getErrors());

        $result=new Result();
        $validator->validate(null,$result);

        $this->assertEquals(['Value is not valid format date YYYY-MM-DD.'],$result->getErrors());
    }

    /**
     *
     */
    public function testCustomMessage(){
        $validator=new DateValidator(['message'=>'Custom message.']);
        $result=new Result();

        $validator->validate(null,$result);

        $this->assertEquals(['Custom message.'],$result->getErrors());
    }

}