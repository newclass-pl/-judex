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


namespace Judex\Validator;

use Judex\AbstractValidator;
use Judex\Result;

/**
 * Validator for date.
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class DateValidator extends AbstractValidator
{

	/**
	 * @var string
	 */
	private $message;

	/**
	 * DateValidator constructor.
	 * @param mixed[] $options
	 */
	public function __construct(array $options = [])
	{
		$options += ['message' => 'Value is not valid format date YYYY-MM-DD.'];
		parent::__construct($options);
	}

	/**
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * @param string $message
	 * @return DateValidator
	 */
	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate($value, Result $result)
	{

		$d = \DateTime::createFromFormat('Y-m-d', $value);
		if (!$d || $d->format('Y-m-d') !== $value) {
			$result->addError($this->message, compact('value'));
		}

	}

}
