<?php

namespace AppBundle\Controller;

use AppBundle\Entity\productRating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Productrating controller.
 *
 * @Route("productrating")
 */
class productRatingController extends Controller
{
    /**
     * Lists all productRating entities.
     *
     * @Route("/", name="productrating_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productRatings = $em->getRepository('AppBundle:productRating')->findAll();

        return $this->render('productrating/index.html.twig', array(
            'productRatings' => $productRatings,
        ));
    }

    /**
     * Creates a new productRating entity.
     *
     * @Route("/new", name="productrating_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $productRating = new Productrating();
        $form = $this->createForm('AppBundle\Form\productRatingType', $productRating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productRating);
            $em->flush();

            return $this->redirectToRoute('productrating_show', array('id' => $productRating->getId()));
        }

        return $this->render('productrating/new.html.twig', array(
            'productRating' => $productRating,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a productRating entity.
     *
     * @Route("/{id}", name="productrating_show")
     * @Method("GET")
     */
    public function showAction(productRating $productRating)
    {
        $deleteForm = $this->createDeleteForm($productRating);

        return $this->render('productrating/show.html.twig', array(
            'productRating' => $productRating,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing productRating entity.
     *
     * @Route("/{id}/edit", name="productrating_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, productRating $productRating)
    {
        $deleteForm = $this->createDeleteForm($productRating);
        $editForm = $this->createForm('AppBundle\Form\productRatingType', $productRating);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productrating_edit', array('id' => $productRating->getId()));
        }

        return $this->render('productrating/edit.html.twig', array(
            'productRating' => $productRating,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a productRating entity.
     *
     * @Route("/{id}", name="productrating_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, productRating $productRating)
    {
        $form = $this->createDeleteForm($productRating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productRating);
            $em->flush();
        }

        return $this->redirectToRoute('productrating_index');
    }

    /**
     * Creates a form to delete a productRating entity.
     *
     * @param productRating $productRating The productRating entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(productRating $productRating)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productrating_delete', array('id' => $productRating->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
