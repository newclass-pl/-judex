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
use Judex\Validator;

/**
 * Validator for telephone.
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class PhoneNumberValidator implements Validator
{

    /**
     * @var string
     */
    private $message;

    /**
     * BooleanValidator constructor.
     * @param string $message
     */
    public function __construct($message = 'Value is not valid format phone number 000000000.')
    {
        $this->message = $message;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Result $result)
    {
        if (!preg_match("/^[1-9][0-9]{8}$/", $value)) {
            return "Invalid telephone format.";
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function isNullable()
    {
        return true;
    }

}