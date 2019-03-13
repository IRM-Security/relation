<?php

namespace Irm\Relation;

/**
 * RelationsLoaderInterface interface
 */
interface RelationsLoaderInterface
{
    /**
     * @param array $options
     * @return \Traversable
     */
    public function findAll($options = []);
}
