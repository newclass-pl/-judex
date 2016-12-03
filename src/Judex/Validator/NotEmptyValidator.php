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
 * Validator for not empty elements.
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class NotEmptyValidator implements Validator
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
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Result $result)
    {
        if ($value === null) {
            $result->addError($this->message);
            return;
        }

        if (is_array($value) && count($value) === 0) {
            $result->addError($this->message);
            return;
        }

        if (is_string($value) && $value === '') {
            $result->addError($this->message);
            return;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isNullable()
    {
        return false;
    }

}
