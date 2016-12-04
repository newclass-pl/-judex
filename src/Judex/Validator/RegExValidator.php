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
 * Validator for reg exp.
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class RegExValidator extends AbstractValidator
{

    /**
     * @var string
     */
    private $message;
    /**
     * @var string
     */
    private $pattern;

    public function __construct($pattern, $message = 'Value is not validated by pattern.')
    {
        $this->message = $message;
        $this->pattern = $pattern;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Result $result)
    {
        if (!preg_match('/' . $this->pattern . '/', $value)) {
            $result->addError($this->message,['value'=>$value,'pattern'=>$this->pattern]);
        }
    }

}
