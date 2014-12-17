<?php
namespace Gemba\AdminBundle\Factory;

interface FactoryInterface
{
    public function create($className);

    public function decorate($className);
}
