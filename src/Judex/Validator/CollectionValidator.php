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

use Judex\AbstractValidator;
use Judex\Result;

/**
 * Validator for collection (array, list).
 * @package Judex\Validator
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CollectionValidator extends AbstractValidator
{

    /**
     * @var string
     */
    private $message;
    /**
     * @var mixed[]
     */
    private $collection;

    public function __construct($collection=[], $message = 'Collection does not contain value "${value}". Available items: "${collection}".')
    {
        $this->message = $message;
        $this->setCollection($collection);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Result $result)
    {
        if (!is_array($value)) {
            $value = [$value];
        }

        foreach ($value as $item) {
            $this->checkItem($item, $result);
        }

    }

    /**
     * @param mixed $item
     * @param Result $result
     */
    private function checkItem($item, Result $result)
    {
        $values = [
            'value' => $item,
            'collection' => implode(', ', $this->collection)
        ];
        if (!in_array($item, $this->collection, true)) {
            $result->addError($this->message,$values);
        }
    }

    /**
     * @return mixed[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param \mixed[] $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

}
