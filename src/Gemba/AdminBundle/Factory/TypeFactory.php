<?php

namespace Gemba\AdminBundle\Factory;


class TypeFactory implements FactoryInterface
{
    private $service_container;

    public function __construct($service_container)
    {
        $this->service_container = $service_container;
    }

    public function create($className)
    {
        $typeName = "\\Gemba\\AdminBundle\\Form\\".ucwords($className).'Type';

        $type = new $typeName();

        $this->decorate($type);

        return $type;
    }

    public function decorate($className)
    {

    }
}
