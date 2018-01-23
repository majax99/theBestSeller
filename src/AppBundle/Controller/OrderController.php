<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Entity\Product;
use AppBundle\Entity\Bid;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Order controller.
 *
 * @Route("order", name="order")
 */
class OrderController extends Controller
{

    /**
     * Finds and displays a bid entity for a product.
     *
     * @Route("/{id}/bid/new", name="productBid_show")
     * @Method({"GET", "POST"})
     */
    public function newBidAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $bid_request = $em->getRepository('AppBundle:Product')->myFindBidMax($product->getId());
        //$products = $em->getRepository('AppBundle:Product')->myFindOneBids($product->getId());


        $bid = new Bid();
        $bid->setProduct($product);
        $bid->setBuyer($this->getUser());

        $form = $this->createForm('AppBundle\Form\BidType', $bid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();

            return $this->redirectToRoute('ordershow', array('id' => $product->getId()));
        }

        return $this->render('bid/new.html.twig', array(
            /*'products' => $products,*/
            'products' => $bid_request,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bid entity for a product.
     *
     * @Route("/{id}/buy/new", name="productBuy_pay")
     * @Method({"GET", "POST"})
     */
    public function immediateBuyAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $bid_request = $em->getRepository('AppBundle:Product')->myFindBidMax($product->getId());
        //$products = $em->getRepository('AppBundle:Product')->myFindOneBids($product->getId());


        $bid = new Bid();
        $bid->setProduct($product);
        $bid->setBuyer($this->getUser());

        $form = $this->createForm('AppBundle\Form\BidType', $bid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();

            return $this->redirectToRoute('ordershow', array('id' => $product->getId()));
        }

        return $this->render('bid/new.html.twig', array(
            /*'products' => $products,*/
            'products' => $bid_request,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays an order entity.
     *
     * @Route("/{id}", name="show", requirements={"page"="\d+"})
     * @Method("GET")
     */
    public function showAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->myFindOne($product->getId());
        return $this->render('order/show.html.twig', array(
            'product' => $products[0],
        ));
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}
