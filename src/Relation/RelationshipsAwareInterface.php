<?php

declare(strict_types=1);

namespace Irm\Relation;

interface RelationshipsAwareInterface
{
    /**
     * @return ResultSetContextInterface|RelationshipsAwareInterface
     */
    public function getRelationContext();

    public function getRelationLoader(string $id): RelationsLoaderInterface;

    public function getRelationHandler(array $config): RelationInterface;
}
