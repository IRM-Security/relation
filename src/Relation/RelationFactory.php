<?php

namespace Irm\Relation;

/**
 * RelationsFactory interface
 */
class RelationFactory
{
    /**
     * @param array $config
     * @return RelationInterface
     */
    public static function getInstance(array $config)
    {
        /** @var RelationInterface $relation */
        $relation = $config['type'];
        return new $relation($config);
    }
}
