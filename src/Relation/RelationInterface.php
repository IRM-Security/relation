<?php

declare(strict_types=1);

namespace Irm\Relation;

interface RelationInterface
{
    public function load(RelationshipsAwareInterface $model);
}
