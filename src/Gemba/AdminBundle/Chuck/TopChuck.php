<?php

namespace Gemba\AdminBundle\Chuck;

use Gemba\BlockBundle\Chuck\Chuck;

class TopChuck extends Chuck
{
    public function getTemplate()
    {
        return 'GembaAdminBundle:Chuck:TopChuck.html.twig';
    }

    public function getParameters()
    {

        $top = $this->get('top')->find(1) ? $this->get('top')->find(1) : $this->get('entity_factory')->create('top');

        return [ 'top' => $top ];
    }

    public function getName()
    {
        return 'bottom_chuck';
    }
}
