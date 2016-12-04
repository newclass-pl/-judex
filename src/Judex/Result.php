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
 * Class Result
 * @package Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class Result
{
    /**
     * @var string[]
     */
    private $errors=[];

    /**
     * @param $message
     * @param mixed[] $values
     */
    public function addError($message,$values=[]){
        $this->errors[]=$this->filterMessage($message,$values);
    }

    /**
     * @return bool
     */
    public function isValid(){
        return count($this->errors)===0;
    }

    /**
     * @return string[]
     */
    public function getErrors(){
        return $this->errors;
    }

    /**
     * @param string $message
     * @param mixed[] $values
     * @return string
     */
    private function filterMessage($message,$values){
        return preg_replace_callback('/\$\{(.+?)\}/',function ($match) use($values){
            return $values[$match[1]];
        },$message);

    }
}