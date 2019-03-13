<?php

namespace Irm\Relation;

/**
 * AbstractRelation class
 */
abstract class AbstractRelation implements RelationInterface
{
    const CONFIG_RESULT_SET = 'resultSet';
    const CONFIG_KEY_PROPERTY = 'property';
    const CONFIG_KEY_TYPE = 'type';
    const CONFIG_KEY_ON = 'on';
    const CONFIG_KEY_MODEL = 'model';

    /**
     * @var bool
     */
    protected $loaded = false;

    /**
     * @var \Traversable|null
     */
    protected $emptyResult;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * AbstractRelation constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getChildModel()
    {
        return $this->config[self::CONFIG_KEY_MODEL];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->config[self::CONFIG_KEY_TYPE];
    }

    /**
     * @return array
     */
    public function getOn()
    {
        return $this->config[self::CONFIG_KEY_ON];
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->config[self::CONFIG_KEY_PROPERTY];
    }

    /**
     * @return string
     */
    public function getResultSetClass()
    {
        return $this->config[self::CONFIG_RESULT_SET] ?? \ArrayIterator::class;
    }

    /**
     * @param array $ids
     * @return string
     */
    protected function concatCompositeKeys($ids)
    {
        return implode('_', $ids);
    }

    /**
     * @param RelationshipsAwareInterface $model
     * @return RelationsLoaderInterface
     */
    protected function getLoader(RelationshipsAwareInterface $model)
    {
        $class = $this->getChildModel();
        return $model->getRelationsContainer()->get($class);
    }
}
