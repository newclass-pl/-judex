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
 * Validator for email.
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class EmailValidator extends AbstractValidator
{

    /**
     * @var string
     */
    private $message;

    /**
     * BooleanValidator constructor.
     * @param string $message
     */
    public function __construct($message = 'Value is not valid format email.')
    {
        $this->message = $message;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Result $result)
    {

        if (!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+$/", $value)) {
            $result->addError($this->message, compact('value'));
        }
    }

}