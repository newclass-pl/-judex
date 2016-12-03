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
 * Class OptionNotFoundException
 * @package Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class OptionNotFoundException extends ValidatorException
{

    /**
     * OptionNotFoundException constructor.
     * @param string $option
     */
    public function __construct($option)
    {
        parent::__construct('Option "'.$option.'" not found.');
    }
}