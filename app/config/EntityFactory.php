<?php
namespace Gemba\AdminBundle\Factory;


class EntityFactory implements FactoryInterface
{

    private $service_container;

    public function __construct($service_container)
    {
        $this->service_container = $service_container;
    }

    public function create($className)
    {
        $entityName = "\\Gemba\\AdminBundle\\Entity\\".ucwords($className);

        $entity = new $entityName();

        $this->decorate($entity);

        return $entity;
    }

    public function decorate($className)
    {

    }
}
