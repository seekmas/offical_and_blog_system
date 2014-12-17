<?php

namespace Gemba\AdminBundle\Chuck;

use Gemba\BlockBundle\Chuck\Chuck;

class MenuChuck extends Chuck
{
    public function getTemplate()
    {
        return 'GembaAdminBundle:Chuck:MenuChuck.html.twig';
    }

    public function getParameters()
    {

        $blocks = $this->get('block')->findAllOrderBy('sort' , 'asc');

        return [ 'blocks' => $blocks ];
    }

    public function getName()
    {
        return 'menu_chuck';
    }
}
