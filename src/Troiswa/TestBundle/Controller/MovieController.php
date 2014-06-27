<?php

namespace Troiswa\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Troiswa\TestBundle\Controller\AbstractController;

use Troiswa\TestBundle\Entity\Movie;
use Troiswa\TestBundle\Entity\MovieTag;
use Troiswa\TestBundle\Entity\Category;
use Troiswa\TestBundle\Form\MovieType;

/**
 * Movie controller.
 *
 */
class MovieController extends AbstractController
{

    /**
     * Lists all Movie entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $breadtab = array('Tous les films' => 'actor', 'affichage' => null);
        $this->breadcrumbs($breadtab);

        $entities = $em->getRepository('TroiswaTestBundle:Movie')->findAll();

        if ($request->isXmlHttpRequest())
        {
            $search = $request->query->get('word');
            $searchs = $em->getRepository('TroiswaTestBundle:Movie')->search($search);
            return new JsonResponse($searchs);
        }
        return $this->render('TroiswaTestBundle:Movie:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Movie entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Movie();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $tags = $entity->getTags();
            $em = $this->getDoctrine()->getManager();
            $entity->setTags();

            $em->persist($entity);
            $em->flush();

            if ($tags)
            {
                foreach ($tags as $key => $value) {
                    $value->setMovie($entity);
                    $em->persist($value);
                }
                $em->flush();
            }

            return $this->redirect($this->generateUrl('movie_show', array('id' => $entity->getId())));
        }

        return $this->render('TroiswaTestBundle:Movie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Movie entity.
    *
    * @param Movie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Movie $entity)
    {
        $form = $this->createForm(new MovieType(), $entity, array(
            'action' => $this->generateUrl('movie_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Movie entity.
     *
     */
    public function newAction()
    {
        $entity = new Movie();
        $form   = $this->createCreateForm($entity);

        return $this->render('TroiswaTestBundle:Movie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Movie entity.
     *
     */
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TroiswaTestBundle:Movie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movie entity.');
        }

        $response = new Response();
        $response->setETag(md5($entity->getTitre()));
        $response->setLastModified($entity->getDateModify());

        $response->setPublic();

        if ($response->isNotModified($request))
        {
            return $response;
        }

        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('TroiswaTestBundle:Seance')->findByMovie($entity->getId());

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TroiswaTestBundle:Movie:show.html.twig',
            array(
            'entity' => $entity,
            'seances' => $seances,
            'delete_form' => $deleteForm->createView()
            ), $response);
    }

    /**
     * Displays a form to edit an existing Movie entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TroiswaTestBundle:Movie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movie entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TroiswaTestBundle:Movie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Movie entity.
    *
    * @param Movie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Movie $entity)
    {
        $form = $this->createForm(new MovieType(), $entity, array(
            'action' => $this->generateUrl('movie_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Movie entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TroiswaTestBundle:Movie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $data = $request->request->get('troiswa_testbundle_movie');
            
            if (isset($data['category']))
            {
                $category = new Category();
                $category->setTitre($data['category']);
                $validator = $this->get('validator');
                $errors = $validator->validate($category);
                if(count($errors) == 0)
                {
                    $em->persist($category);
                    $entity->setCategory($category);
                }
            }

            $oldTags = $entity->getOldTags();
            if ($oldTags)
            {
                foreach ($oldTags as $value) {
                    $em->remove($value);
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('movie_edit', array('id' => $id)));
        }

        return $this->render('TroiswaTestBundle:Movie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Movie entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TroiswaTestBundle:Movie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Movie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('movie'));
    }

    /**
     * Creates a form to delete a Movie entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('movie_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}