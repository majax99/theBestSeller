<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserRating;
use AppBundle\Entity\User;
use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Userrating controller.
 *
 * @Route("userrating")
 */
class UserRatingController extends Controller
{
    /**
     * Lists all userRating entities.
     *
     * @Route("/", name="userrating_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userRatings = $em->getRepository('AppBundle:UserRating')->findAll();

        return $this->render('userrating/index.html.twig', array(
            'userRatings' => $userRatings,
        ));
    }

    /**
     * Creates a new userRating entity.
     *
     * @Route("/new", name="userrating_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userRating = new Userrating();
        $form = $this->createForm('AppBundle\Form\UserRatingType', $userRating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userRating);
            $em->flush();

            return $this->redirectToRoute('userrating_show', array('id' => $userRating->getId()));
        }

        return $this->render('userrating/new.html.twig', array(
            'userRating' => $userRating,
            'form' => $form->createView(),
        ));
    }


    /**
     * Creates a new userRating entity.
     *
     * @Route("/{user}/{product}/rate", name="userRate")
     * @Method({"GET", "POST"})
     */
    public function newRateUserAction(Request $request, User $user, Product $product)
    {
        $userRating = new Userrating();
        $userRating->setuserRate($user);
        $userRating->setrater($this->getUser());
        $userRating->setProduct($product->getId());
        $form = $this->createForm('AppBundle\Form\UserRatingType', $userRating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userRating);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('userrating/rateUser.html.twig', array(
            'userRating' => $userRating,
            'form' => $form->createView(),
            'user' => $user,
        ));
    }

    /**
     * Finds and displays a userRating entity.
     *
     * @Route("/{id}", name="userrating_show")
     * @Method("GET")
     */
    public function showAction(UserRating $userRating)
    {
        $deleteForm = $this->createDeleteForm($userRating);

        return $this->render('userrating/show.html.twig', array(
            'userRating' => $userRating,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userRating entity.
     *
     * @Route("/{id}/edit", name="userrating_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserRating $userRating)
    {
        $deleteForm = $this->createDeleteForm($userRating);
        $editForm = $this->createForm('AppBundle\Form\UserRatingType', $userRating);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userrating_edit', array('id' => $userRating->getId()));
        }

        return $this->render('userrating/edit.html.twig', array(
            'userRating' => $userRating,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userRating entity.
     *
     * @Route("/{id}", name="userrating_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserRating $userRating)
    {
        $form = $this->createDeleteForm($userRating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userRating);
            $em->flush();
        }

        return $this->redirectToRoute('userrating_index');
    }

    /**
     * Creates a form to delete a userRating entity.
     *
     * @param UserRating $userRating The userRating entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserRating $userRating)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userrating_delete', array('id' => $userRating->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
