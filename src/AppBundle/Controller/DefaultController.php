<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:Product')->myFindAll();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * @Route("/products/{productId}", name="products")
     */
    public function showAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        return $this->render('default/products.html.twig', array('product' => $product));

        // ... do something, like pass the $product object into a template
    }
}
