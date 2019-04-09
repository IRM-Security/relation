<?php

namespace Irm\Relation;

/**
 * RelationHasMany class
 */
class RelationHasMany extends DirectRelation
{
    /**
     * @var \Traversable|null
     */
    protected $emptyResult;

    /**
     * @return \Traversable
     */
    protected function getEmptyResult()
    {
        if (!$this->emptyResult) {
            $class = $this->getResultSetClass();
            $this->emptyResult = new $class;
        }

        return clone $this->emptyResult;
    }

    /**
     * @inheritDoc
     */
    protected function getPropertyValueForModel($key)
    {
        if (empty($this->childrenGroup[$key])) {
            return $this->getEmptyResult();
        } else {
            $class = $this->getResultSetClass();
            return new $class($this->childrenGroup[$key]);
        }
    }
}
