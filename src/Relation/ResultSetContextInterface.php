<?php

declare(strict_types=1);

namespace Irm\Relation;

interface ResultSetContextInterface extends \Traversable
{
    public function extractUnique(string $key): array;
}
