<?php

namespace Irm\Relation;

/**
 * AbstractRelation class
 */
class RelationHasOne extends DirectRelation
{
    /**
     * @inheritDoc
     */
    protected function getPropertyValueForModel($key)
    {
        return $this->childrenGroup[$key][0] ?? null;
    }
}
