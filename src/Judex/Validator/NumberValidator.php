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
     * BooleanValidator constructor.
     * @param $options
     * @throws OptionNotFoundException
     */
    public function __construct($options=[])
    {
        $options += ['messageType' => 'Value is not valid number.',
            'messageMin' => 'Value is too small. Min value is ${min}.',
            'messageMax' => 'Value is too big. Max value is ${max}.', 'min' => null, 'max' => null,];
        foreach ($options as $kOption => $option) {
            $methodName = 'set' . ucfirst($kOption);
            if (!method_exists($this, $methodName)) {
                throw new OptionNotFoundException($kOption);
            }

            call_user_func([$this, $methodName], $option);
        }
    }

    /**
     * @param string $message
     */
    public function setMessageType($message)
    {
        $this->messageType = $message;
    }

    /**
     * @param string $message
     */
    public function setMessageMin($message)
    {
        $this->messageMin = $message;
    }

    /**
     * @param int $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @param int $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

    /**
     * @param string $message
     */
    public function setMessageMax($message)
    {
        $this->messageMax = $message;
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
