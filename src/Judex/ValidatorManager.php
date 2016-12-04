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
 * Class ValidatorManager
 * @package Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class ValidatorManager
{
    /**
     * @var AbstractValidator[]
     */
    private $validators;

    /**
     * @param AbstractValidator $validator
     */
    public function addValidator(AbstractValidator $validator)
    {
        $this->validators[get_class($validator)] = $validator;
    }

    /**
     * @return AbstractValidator[]
     */
    public function getValidators()
    {
        return $this->validators;
    }

    /**
     * @param string $name
     * @return AbstractValidator
     * @throws ValidatorNotFoundException
     */
    public function getValidator($name)
    {
        if(!isset($this->validators[$name])){
            throw new ValidatorNotFoundException($name);
        }
        return $this->validators[$name];
    }

    /**
     * @param string $name
     * @return $this
     * @throws ValidatorNotFoundException
     */
    public function removeValidator($name)
    {
        if(!isset($this->validators[$name])){
            throw new ValidatorNotFoundException($name);
        }
        unset($this->validators[$name]);
        return $this;
    }

    /**
     * @param mixed $value
     * @return Result
     */
    public function validate($value)
    {
        $result = new Result();
        foreach ($this->validators as $validator) {
            if ($validator->isNullable() && ($value === null || is_string($value) && $value === '')) {
                continue;
            }

            $validator->validate($value, $result);

        }

        return $result;
    }
}