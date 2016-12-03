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
 * Throw when value not found in SessionProvider,ArrayList,Map.
 * @package Judex
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class ValueNotFoundException extends \Exception{
	
	/**
	 * Constructor.
	 *
	 * @param string $name
	 */
	public function __construct($name){
		parent::__construct('Value "'.$name.'" not found.');
	}
}