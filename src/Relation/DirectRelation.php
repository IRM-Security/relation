<?php

namespace Irm\Relation;

/**
 * DirectRelation class
 */
abstract class DirectRelation extends AbstractRelation
{
    /**
     * @var bool
     */
    protected $loaded = false;

    /**
     * @var \Traversable|array
     */
    protected $children;

    /**
     * @var array
     */
    protected $childrenGroup;

    /**
     * @var array
     */
    protected $parentOnKeys = [];

    /**
     * @var array
     */
    protected $childOnKeys = [];

    /**
     * @var string
     */
    protected $relationKeyMethod = 'getSingleRelationKey';

    /**
     * @param string $key
     * @return mixed
     */
    abstract protected function getPropertyValueForModel($key);

    /**
     * @inheritDoc
     */
    public function __construct($config)
    {
        parent::__construct($config);

        $this->parentOnKeys = array_values($this->getOn());
        $this->childOnKeys = array_keys($this->getOn());

        if (count($this->getOn()) > 1) { // slower...
            $this->relationKeyMethod = 'getCompositeRelationKey';
        }
    }

    /**
     * @inheritDoc
     */
    public function load(RelationshipsAwareInterface $model)
    {
        if (!$this->loaded) {
            $filter = $this->buildOnFilter($model);
            $children = $this->loadChildrenWithFilter($model, $filter);
            $this->setChildren($children);
        }

        $key = $this->{$this->relationKeyMethod}($this->parentOnKeys, $model);

        return $this->getPropertyValueForModel($key);
    }

    /**
     * @param \Traversable $children
     */
    protected function setChildren(\Traversable $children)
    {
        $this->children = $children;

        foreach ($children as $child) {
            $key = $this->{$this->relationKeyMethod}($this->childOnKeys, $child);
            $this->childrenGroup[$key][] = $child;
        };
    }

    /**
     * @param array $properties
     * @param RelationshipsAwareInterface $model
     * @return string
     */
    protected function getSingleRelationKey($properties, $model)
    {
        return $model->{'get' . ucfirst($properties[0])}();
    }

    /**
     * @param array $properties
     * @param RelationshipsAwareInterface $model
     * @return string
     */
    protected function getCompositeRelationKey($properties, $model)
    {
        $keys = [];
        foreach ($properties as $property) {
            $keys[] = $model->{'get' . ucfirst($property)}();
        }

        return $this->concatCompositeKeys($keys);
    }

    /**
     * @param RelationshipsAwareInterface $model
     * @return array
     */
    protected function buildOnFilter(RelationshipsAwareInterface $model)
    {
        $filter = [];
        foreach ($this->getOn() as $childModelProperty => $parentModelProperty) {
            $filter[$childModelProperty] = $this->getFilterValueFromContext($model, $parentModelProperty);
        }

        if (!$filter) {
            trigger_error('No relationship filter specified', E_USER_NOTICE);
        }

        return $filter;
    }

    /**
     * @param array $filter
     * @param RelationshipsAwareInterface $model
     * @return \Traversable
     */
    protected function loadChildrenWithFilter(RelationshipsAwareInterface $model, $filter)
    {
        $this->loaded = true;
        return $this->getLoader($model)->findAll($filter);
    }

    /**
     * @param RelationshipsAwareInterface $model
     * @param string $property
     * @return array
     */
    protected function getFilterValueFromContext(RelationshipsAwareInterface $model, $property)
    {
        $context = $model->getRelationsContainer()->getContext();

        if ($context instanceof ResultSetContextInterface) {
            return $context->extractUnique($property);
        } else {
            return $model->{'get' . ucfirst($property)}();
        }
    }
}
