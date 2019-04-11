<?php

declare(strict_types=1);

namespace Irm\Relation;

interface RelationsLoaderInterface
{
    /**
     * @param array $options
     * @return \Traversable
     */
    public function findAll($options = []);
}
