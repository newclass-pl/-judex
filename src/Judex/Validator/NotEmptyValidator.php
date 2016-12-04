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

use Judex\Result;
use Judex\AbstractValidator;

/**
 * Validator for not empty elements.
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class NotEmptyValidator extends AbstractValidator
{

    /**
     * @var string
     */
    private $message;

    /**
     * BooleanValidator constructor.
     * @param string $message
     */
    public function __construct($message = 'Value can\'t be empty.')
    {
        $this->message = $message;
        $this->setNullable(false);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Result $result)
    {
        if ($value === null) {
            $result->addError($this->message,compact('value'));
            return;
        }

        if (is_array($value) && count($value) === 0) {
            $result->addError($this->message,compact('value'));
            return;
        }

        if (is_string($value) && $value === '') {
            $result->addError($this->message,compact('value'));
            return;
        }
    }

}
