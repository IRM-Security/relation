<?php

declare(strict_types=1);

namespace Irm\Relation;

class HasOne extends AbstractRelation
{
    protected function getPropertyValueForModel(string $key): ?RelationshipsAwareInterface
    {
        return $this->groupedChildren[$key][0] ?? null;
    }
}
