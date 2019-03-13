<?php

namespace Irm\Relation;

use Psr\Container\ContainerInterface;

/**
 * RelationsContainerInterface interface
 */
interface RelationsContainerInterface extends ContainerInterface
{
    /**
     * @return ResultSetContextInterface|RelationshipsAwareInterface
     */
    public function getContext();
}
