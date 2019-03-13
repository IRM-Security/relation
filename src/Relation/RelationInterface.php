<?php

namespace Irm\Relation;

/**
 * Interface RelationInterface
 */
interface RelationInterface
{
    /**
     * @param RelationshipsAwareInterface $model
     * @return mixed
     */
    public function load(RelationshipsAwareInterface $model);
}
