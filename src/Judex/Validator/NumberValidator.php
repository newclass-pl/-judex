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

use Judex\OptionNotFoundException;
use Judex\Result;
use Judex\AbstractValidator;

/**
 * Validator for number.
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class NumberValidator extends AbstractValidator
{

    /**
     * @var string
     */
    private $messageType;
    /**
     * @var string
     */
    private $messageMin;
    /**
     * @var string
     */
    private $messageMax;
    /**
     * @var int
     */
    private $min;
    /**
     * @var int
     */
    private $max;

	/**
	 * NumberValidator constructor.
	 * @param mixed[] $options
	 */
    public function __construct(array $options=[])
    {
        $options += ['messageType' => 'Value is not valid number.',
            'messageMin' => 'Value is too small. Min value is ${min}.',
            'messageMax' => 'Value is too big. Max value is ${max}.', 'min' => null, 'max' => null,];
		parent::__construct($options);
    }

	/**
	 * @return string
	 */
	public function getMessageType()
	{
		return $this->messageType;
	}

	/**
	 * @param string $messageType
	 * @return NumberValidator
	 */
	public function setMessageType($messageType)
	{
		$this->messageType = $messageType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessageMin()
	{
		return $this->messageMin;
	}

	/**
	 * @param string $messageMin
	 * @return NumberValidator
	 */
	public function setMessageMin($messageMin)
	{
		$this->messageMin = $messageMin;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessageMax()
	{
		return $this->messageMax;
	}

	/**
	 * @param string $messageMax
	 * @return NumberValidator
	 */
	public function setMessageMax($messageMax)
	{
		$this->messageMax = $messageMax;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMin()
	{
		return $this->min;
	}

	/**
	 * @param int $min
	 * @return NumberValidator
	 */
	public function setMin($min)
	{
		$this->min = $min;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMax()
	{
		return $this->max;
	}

	/**
	 * @param int $max
	 * @return NumberValidator
	 */
	public function setMax($max)
	{
		$this->max = $max;
		return $this;
	}

    /**
     * {@inheritdoc}
     */
    public function validate($value, Result $result)
    {
        if (!is_numeric($value)) {
            $result->addError($this->messageType,['value'=>$value,'min'=>$this->min,'max'=>$this->max]);
            return null;
        }

        if ($this->min !== null && $value < $this->min) {
            $result->addError($this->messageMin,['value'=>$value,'min'=>$this->min,'max'=>$this->max]);
        }

        if ($this->max !== null && $value > $this->max) {
            $result->addError($this->messageMax,['value'=>$value,'min'=>$this->min,'max'=>$this->max]);
        }
    }

}
