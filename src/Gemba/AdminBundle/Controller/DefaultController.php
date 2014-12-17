<?php

namespace Gemba\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/" , name="admin_home")
     * @Template()
     */
    public function indexAction()
    {

        $block = $this->get('block')->findOneBy(['aliasForUrl' => '/']);




        return [
            'block' => $block,
            'layouts' => $block->getLayout()
        ];
    }

}
