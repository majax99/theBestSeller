<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Entity\Product;
use AppBundle\Entity\Bid;
use AppBundle\Entity\User;
use AppBundle\Entity\productRating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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


        $bid = new Bid();
        $bid->setProduct($product);
        $bid->setBuyer($this->getUser());

        $form = $this->createForm('AppBundle\Form\BidType', $bid);
        $form->handleRequest($request);
        $bidAmount = $bid->getBidAccount();
        $minBid = $request->request->get('minBid');
        if ($form->isSubmitted() && $form->isValid() && $minBid < $bidAmount) {

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
     * @Route("/{id}/buy", name="productBuy_pay")
     * @Method({"GET", "POST"})
     */
    public function immediateOrderAction(Request $request, Product $product)
    {
        $form = $this->createFormBuilder()
            ->add('Pay the product', SubmitType::class, array('attr' => ['class' => 'btn btn-success']))
            ->getForm();
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $order = new Orders();
        $order->setProduct($product);
        $order->setBuyer($this->getUser());
        $order->setSeller($product->getuser());
        $order->setPrice($product->getimmediatePrice());
        $order->setImmediateSell(true);
        $order->setCategory($product->getCategory());


        $products = $em->getRepository('AppBundle:Product')->myFindOne($product->getId());

        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

            return $this->redirectToRoute('userRate', array('user' => $product->getUser()->getid(), 'product' => $product->getid()));
        }



        return $this->render('order/immediateOrder.html.twig', array(
            'product' => $products[0],
            'form' => $form->createView(),
        ));
    }



    /**
     * Finds and displays an order entity.
     *
     * @Route("/{id}", name="show", requirements={"page"="\d+"})
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, Product $product)
    {


        $productRating = new Productrating();

        $productRating->setProduct($product);
        $productRating->setRater($this->getUser());
        $form = $this->createForm('AppBundle\Form\productRatingType', $productRating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productRating);
            $em->flush();

            return $this->redirectToRoute('ordershow', array('id' => $product->getId()));
        }


        $em = $this->getDoctrine()->getManager();
        $views = $product->getProductVisits();
        $product->setProductVisits($views + 1);
        $em->persist($product);
        $em->flush();

        $products = $em->getRepository('AppBundle:Product')->myFindOne($product->getId());
        $bids = $em->getRepository('AppBundle:Bid')->myFindBid($product->getId());
        $rate = $em->getRepository('AppBundle:productRating')->countRateProduct($product->getId());
        $rateProduct = $em->getRepository('AppBundle:productRating')->MyProductRate($product->getId());
        return $this->render('order/show.html.twig', array(
            'product' => $products[0],
            'form' => $form->createView(),
            'bids' => $bids,
            'rate' => $rate[0],
            'rateProduct' => $rateProduct,
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

    /**
     * Finds and displays an order entity.
     *
     * @Route("/user/{id}", name="show_myOrders", requirements={"page"="\d+"})
     * @Method({"GET"})
     */
    public function MyOrdersAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $orders = $em->getRepository('AppBundle:Orders')->OrdersByUsers($user->getId());

        return $this->render('order/ordersUser.html.twig', array(
            'orders' => $orders,
        ));

    }


    /**
     * Delete a user
     *
     * @Route("/user/{id}/delete", name="delete_user", requirements={"page"="\d+"})
     * @Method({"GET", "POST"})
     */
    public function DeleteUserAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm('AppBundle\Form\UserDeleteType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            echo "toto";
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $user = $em->getRepository('AppBundle:User')->find($user->getId());

        return $this->render('order/userDelete.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));

    }

}
