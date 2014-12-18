<?php

namespace Gemba\AdminBundle\Chuck;

use Gemba\BlockBundle\Chuck\Chuck;

class BottomChuck extends Chuck
{
    public function getTemplate()
    {
        return 'GembaAdminBundle:Chuck:BottomChuck.html.twig';
    }

    public function getParameters()
    {

        $blocks = $this->get('bottom')->findAllOrderBy('sort' , 'asc');

        return [ 'blocks' => $blocks ];
    }

    public function getName()
    {
        return 'bottom_chuck';
    }
}
