<?php

namespace Gemba\AdminBundle\Chuck;

use Gemba\BlockBundle\Chuck\Chuck;

class LogoChuck extends Chuck
{
    public function getTemplate()
    {
        return 'GembaAdminBundle:Chuck:LogoChuck.html.twig';
    }

    public function getParameters()
    {

        $block = $this->get('logo')->find(1);

        return [ 'block' => $block ];
    }

    public function getName()
    {
        return 'logo_chuck';
    }
}
