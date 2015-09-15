<?php

namespace Auctores\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AuctoresBlogBundle:Default:index.html.twig');
    }
}
