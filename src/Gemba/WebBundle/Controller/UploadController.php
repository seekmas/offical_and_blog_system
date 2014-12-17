<?php

namespace Gemba\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Goutte\Client;

class UploadController extends Controller
{
    /**
     * @Route("/" , name="upload")
     */
    public function indexAction(Request $request)
    {

        $file = $request->files->get('file');

        $type = $file->getMimeType();

        $type = strtolower($type);

        if ($type == 'image/png'
            || $type == 'image/jpg'
            || $type == 'image/gif'
            || $type == 'image/jpeg'
            || $type == 'image/pjpeg')
        {
            // setting file's mysterious name
            $filename = md5(date('YmdHis')).'.jpg';

            $file->move($this->get('kernel')->getRootDir().'/../web/editors/' , $filename);
            // displaying file
            $array = array(
                'filelink' => '/editors/'.$filename
            );

            echo stripslashes(json_encode($array));
            return new Response();
        }
    }

    /**
     * @Route("/goutte" , name="upload_goutte")
     */
    public function goutteAction(Request $request)
    {
//        $client = new Client();
//        $crawler = $client->request('GET', 'http://h5-impress.secret-cn.com/impress/?code=obk6yuDpYgIdTQFWy77hsDkRIUHo&openid=obk6yuDWDdoBq2DSVIOiZpCiPl4c&issubscribe=1');
//        $crawler = $client->click($crawler->selectLink('Sign in')->link());
//        $form = $crawler->selectButton('#submitTag')->form();
//        $crawler = $client->submit($form, array('login' => 'fabpot', 'password' => 'xxxxxx'));
//        $crawler->filter('.flash-error')->each(function ($node) {
//            print $node->text()."\n";
//        });
    }
}
