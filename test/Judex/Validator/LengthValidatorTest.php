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
use Judex\Validator\LengthValidator;

/**
 * Class LengthValidatorTest
 * @package Test\Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class LengthValidatorTest extends \PHPUnit_Framework_TestCase
{

	/**
	 *
	 */
	public function testValidateSuccess()
	{
		$validator = new LengthValidator(['min' => 1, 'max' => 10,]);
		$resultMock = $this->getMockBuilder(Result::class)->getMock();
		$resultMock->expects($this->never())->method('addError');

		$validator->validate('Short text', $resultMock);

	}

	/**
	 *
	 */
	public function testValidateFail()
	{

		$result = new Result();
		$validator = new LengthValidator();
		$validator->setMin(11);

		$validator->validate('Short text', $result);

		$this->assertEquals(['Value is too short. Min length is 11.'], $result->getErrors());

		$result = new Result();
		$validator = new LengthValidator();
		$validator->setMax(2);

		$validator->validate('Short text', $result);

		$this->assertEquals(['Value is too long. Max length is 2.'], $result->getErrors());

	}

	/**
	 *
	 */
	public function testCustomMessage()
	{
		$validator = new LengthValidator(['messageMin' => 'Min message.', 'messageMax' => 'Max message']);
		$validator->setMin(10);
		$validator->setMax(1);
		$result = new Result();

		$validator->validate('text', $result);

		$this->assertEquals(['Min message.','Max message',], $result->getErrors());
	}

}