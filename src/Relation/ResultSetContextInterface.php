<?php

namespace Irm\Relation;

/**
 * ResultSetContextInterface interface
 */
interface ResultSetContextInterface extends \Traversable
{
    /**
     * @param string $key
     * @return array
     */
    public function extractUnique($key);
}
