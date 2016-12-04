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


use Judex\OptionNotFoundException;
use Judex\Result;
use Judex\Validator\NumberValidator;

/**
 * Class NumberValidatorTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class NumberValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testValidateSuccess()
    {
        $validator = new NumberValidator();
        $resultMock = $this->getMockBuilder(Result::class)->getMock();
        $resultMock->expects($this->never())->method('addError');

        $validator->validate(10, $resultMock);
        $validator->validate(0, $resultMock);
        $validator->validate(123.32, $resultMock);

        $validator = new NumberValidator(['min' => -20, 'max' => 200,]);

        $validator->validate(-20, $resultMock);
        $validator->validate(200, $resultMock);

    }

    /**
     *
     */
    public function testValidateFail()
    {
        $validator = new NumberValidator(['min' => -20, 'max' => 30,]);

        $result = new Result();
        $validator->validate(-21, $result);

        $this->assertEquals(['Value is too small. Min value is -20.'], $result->getErrors());

        $result = new Result();
        $validator->validate(31, $result);

        $this->assertEquals(['Value is too big. Max value is 30.'], $result->getErrors());

        $result = new Result();
        $validator->validate('not number', $result);

        $this->assertEquals(['Value is not valid number.'], $result->getErrors());

    }

    /**
     *
     */
    public function testCustomMessage()
    {
        $validator = new NumberValidator([
            'messageType'=>'Invalid type.',
            'messageMin'=>'Invalid min.',
            'messageMax'=>'Invalid max.',
            'min'=>1,
            'max'=>10,
        ]);

        $result = new Result();
        $validator->validate('test', $result);
        $this->assertEquals(['Invalid type.'], $result->getErrors());

        $result = new Result();
        $validator->validate(0, $result);
        $this->assertEquals(['Invalid min.'], $result->getErrors());

        $result = new Result();
        $validator->validate(20, $result);
        $this->assertEquals(['Invalid max.'], $result->getErrors());

    }

    /**
     *
     */
    public function testOptionNotFoundException()
    {
        $this->expectException(OptionNotFoundException::class);
        new NumberValidator(['unknwon'=>1]);

    }

}