<?php

namespace OC\NoLogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
			
        return $this->render('OCNoLogBundle:Default:index.html.twig');
    }
}
