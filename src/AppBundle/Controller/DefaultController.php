<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\Order;
use AppBundle\Entity\Category;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:Product')->myFindAll();

        $categories= $em->getRepository('AppBundle:Category')->countProductCategory();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'products' => $products,
            'categories' => $categories,
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


    /**
     * @Route("/searchBar", name="searchBar")
     * @Method({"GET", "POST"})
     */
    public function searchBarAction()
    {
        return $this->redirectToRoute('searchBarName', array('product' => $_POST['search']));
    }

    /**
     * @Route("/searchBar/{product}", name="searchBarName")
     * @Method({"GET", "POST"})
     */
    public function searchBarNameAction($product)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:Product')->ProductsByName($product);

        $categories= $em->getRepository('AppBundle:Category')->countProductCategory();

        return $this->render('default/searchBarName.html.twig', array(
            'products' => $products,
            'categories' => $categories,
            'search' => $product,
        ));
    }

}
