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

        $seo = $this->get('seo')->find(1);

        $feeds = $this->get('news')->setLimit(10)->findAllOrderBy('id' , 'desc');

        $sliders = $this->get('slider')->findAll();

        return [
            'block' => $block,
            'blogs' => $blogs ,
            'feeds' => $feeds ,
            'layouts' => $block->getLayout() ,
            'sliders' => $sliders ,
            'seo' => $seo ,
        ];
    }
}
