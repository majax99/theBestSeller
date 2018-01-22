<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HelloController extends Controller
{
    /**
     * @Route("/hello", name="hello")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('hello/hello.html.twig');
    }

    /**
     * @Route("/hello/product", name="product")
     */
    public function showAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('hello/product.html.twig');
    }
}
