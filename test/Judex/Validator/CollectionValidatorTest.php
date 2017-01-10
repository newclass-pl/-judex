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


namespace Test\Judex\Validator;

use Judex\Result;
use Judex\Validator\CollectionValidator;


/**
 * Class CollectionValidatorTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CollectionValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testValidateSuccess()
    {
        $validator = new CollectionValidator(['records'=>[
            'r1',
            'r2',
            'r3',
            'r4'
        ]]);
        $resultMock = $this->getMockBuilder(Result::class)->getMock();
        $resultMock->expects($this->never())->method('addError');

        $validator->validate('r1', $resultMock);
        $validator->validate([
            'r2',
            'r3'
        ], $resultMock);

    }

    /**
     *
     */
    public function testValidateFail()
    {
        $validator = new CollectionValidator();
        $validator->setRecords([
            'r1',
            'r2',
            'r3',
            'r4'
        ]);
        $result = new Result();

        $validator->validate('r10', $result);

        $this->assertEquals(['Collection does not contain value "r10". Available items: "r1, r2, r3, r4".'],
            $result->getErrors());

        $result = new Result();

        $validator->validate([
            'r1',
            'r9'
        ], $result);

        $this->assertEquals(['Collection does not contain value "r9". Available items: "r1, r2, r3, r4".'],
            $result->getErrors());

        $result = new Result();

        $validator->validate([
            'r8',
            'r9'
        ], $result);

        $this->assertEquals([
            'Collection does not contain value "r8". Available items: "r1, r2, r3, r4".',
            'Collection does not contain value "r9". Available items: "r1, r2, r3, r4".',
        ], $result->getErrors());

    }

    /**
     *
     */
    public function testCustomMessage()
    {
        $validator = new CollectionValidator(['records'=>['r1'],'message'=>'Custom message.']);
        $result = new Result();

        $validator->validate(null, $result);

        $this->assertEquals(['Custom message.'], $result->getErrors());
    }

}