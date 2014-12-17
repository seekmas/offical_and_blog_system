<?php

namespace Gemba\BlockBundle\Twig;

class RenderChuckExtension extends \Twig_Extension
{

    private $service_container;

    public function __construct($service_container)
    {
        $this->service_container = $service_container;
    }

    public function getFunctions()
    {
        return [
            'chuck' => new \Twig_Function_Method($this, 'chuck' , ['is_safe' => ['html']])
        ];
    }

    public function chuck($chuck_name)
    {
        $chuck = $this->service_container->get($chuck_name);
        return $chuck->render();
    }

    public function getName()
    {
        return 'render_chuck';
    }
}
