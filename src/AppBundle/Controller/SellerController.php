<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Userrating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Productrating controller.
 *
 * @Route("seller")
 */
class SellerController extends Controller
{
    /**
     * Lists all sellers .
     *
     * @Route("/", name="seller_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->MyProductByUser();
        $products = $em->getRepository('AppBundle:Product')->myOrders();

        return $this->render('user/sellers.html.twig', array(
            'users' => $users,
            'products' => $products,
        ));
    }


    /**
     * Lists all sellers .
     *
     * @Route("/{id}", name="seller_details")
     * @Method("GET")
     */
    public function detailAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $views = $user->getUserVisits();
        $user->setUserVisits($views + 1);
        $em->persist($user);
        $em->flush();

        $user = $em->getRepository('AppBundle:User')->MyUserRate($user->getId());

        return $this->render('user/sellers_show.html.twig', array(
            'user' => $user[0],
        ));
    }

    /**
     * Lists all sellers .
     *
     * @Route("/{id}/products", name="seller_products")
     * @Method("GET")
     */
    public function productAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:Product')->myProducts($user->getId());

        return $this->render('user/sellers_show_products.html.twig', array(
            'products' => $products,
        ));
    }

}
