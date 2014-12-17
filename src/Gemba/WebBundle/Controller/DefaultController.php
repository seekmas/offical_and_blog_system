<?php

namespace Gemba\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $block = $this->get('block')->findOneBy(['aliasForUrl' => '/']);
        $blogs = $this->get('blog')->setLimit(10)->findAllOrderBy('click' , 'desc');
        return [
            'block' => $block,
            'blogs' => $blogs ,
            'layouts' => $block->getLayout()
        ];
    }
}
