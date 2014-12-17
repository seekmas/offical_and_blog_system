<?php

namespace Gemba\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlockController extends Controller
{
    /**
    * @Route("/{alias}.html" , name="block_show")
    * @Template()
    */
    public function indexAction(Request $request , $alias)
    {

        $block = $this->get('block')->findOneBy(['aliasForUrl' => $alias]);

        $layouts = $this->get('layout')
                        ->createQueryBuilder('layout')
                        ->select('layout')
                        ->where('layout.blockId = '.$block->getId())
                        ->getQuery()
                        ->getResult();
        return [
            'block' => $block ,
            'layouts' => $layouts
        ];
    }
}
