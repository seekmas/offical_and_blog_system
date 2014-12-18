<?php

namespace Gemba\AdminBundle\Chuck;

use Gemba\BlockBundle\Chuck\Chuck;

class CopyrightChuck extends Chuck
{
    public function getTemplate()
    {
        return 'GembaAdminBundle:Chuck:CopyrightChuck.html.twig';
    }

    public function getParameters()
    {

        $block = $this->get('copyright')->find(1);

        return [ 'block' => $block ];
    }

    public function getName()
    {
        return 'copyright_chuck';
    }
}
