<?php

namespace Irm\Relation;

/**
 * RelationshipsAwareInterface interface
 */
interface RelationshipsAwareInterface
{
    /**
     * @return RelationsContainerInterface
     */
    public function getRelationsContainer();
}
