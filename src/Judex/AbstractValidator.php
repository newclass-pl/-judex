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


namespace Judex;

/**
 * Interface Validator
 * @package Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
abstract class AbstractValidator
{
    /**
     * @var bool
     */
    private $nullable=true;

    /**
     * Implement method to validate value.
     *
     * @param mixed $value - value to parse
     * @param Result $result
     */
    abstract public function validate($value, Result $result);

    /**
     * @return bool
     */
    public final function isNullable(){
        return $this->nullable;
    }

    /**
     * @param bool $flag
     * @return $this
     */
    protected final function setNullable($flag){
        $this->nullable=$flag;
        return $this;
    }

}