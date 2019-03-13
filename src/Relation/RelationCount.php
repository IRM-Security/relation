<?php

namespace Irm\Relation;

/**
 * RelationCount class
 */
class RelationCount extends DirectRelation
{
    /**
     * @return int
     */
    protected function getEmptyResult()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    protected function getPropertyValueForModel($key)
    {
        if (empty($this->childrenGroup[$key])) {
            return $this->getEmptyResult();
        } else {
            return count($this->childrenGroup[$key]);
        }
    }
}
