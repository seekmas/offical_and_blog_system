<?php

namespace Gemba\BlockBundle\Chuck;

class Chuck
{
    private $parameters;

    private $template;

    private $service_container;

    public function __construct($service_container)
    {
        $this->service_container = $service_container;
    }

    public function get($service)
    {
        return $this->service_container->get($service);
    }

    public function render($response = null)
    {
        return $this->get('templating')->render($this->getTemplate(), $this->getParameters(), $response);
    }

    public function getTemplate()
    {
        return ;
    }

    public function getParameters()
    {
        return ;
    }

    public function getName()
    {
        return 'block';
    }
}
