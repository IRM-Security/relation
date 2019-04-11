<?php

declare(strict_types=1);

namespace Irm\Relation;

class RelationFactory
{
    public static function getInstance(array $config): RelationInterface
    {
        $relation = $config['type'];
        return new $relation($config);
    }
}
