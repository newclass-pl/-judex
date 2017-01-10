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
 * Validator for collection (array, list).
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CollectionValidator extends AbstractValidator
{

	/**
	 * @var string
	 */
	private $message;
	/**
	 * @var mixed[][]
	 */
	private $records = [];

	/**
	 * CollectionValidator constructor.
	 * @param mixed[] $options
	 */
	public function __construct(array $options=[])
	{
		$options += ['message' => 'Collection does not contain value "${value}". Available items: "${collection}".',];
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
	 * @return CollectionValidator
	 */
	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}

	/**
	 * @return \mixed[][]
	 */
	public function getRecords()
	{
		return $this->records;
	}

	/**
	 * @param \mixed[][] $records
	 * @return CollectionValidator
	 */
	public function setRecords(array $records)
	{
		$this->records = $records;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate($value, Result $result)
	{
		if (!is_array($value)) {
			$value = [$value];
		}

		foreach ($value as $item) {
			$this->checkItem($item, $result);
		}

	}

	/**
	 * @param mixed $item
	 * @param Result $result
	 */
	private function checkItem($item, Result $result)
	{
		$values = [
			'value' => $item,
			'collection' => implode(', ', $this->records)
		];
		if (!in_array($item, $this->records, true)) {
			$result->addError($this->message, $values);
		}
	}

}
