<?php
// {% transchoice count %}
//     {0} There is no apples|{1} There is one apple|]1,Inf] There are %count% apples
// {% endtranschoice %}
namespace Troiswa\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Troiswa\TestBundle\Entity\Actor;
use Troiswa\TestBundle\Form\ActorType;
use TwitterOAuth\TwitterOAuth;

/**
 * Actor controller.
 *
 */
class ActorController extends Controller
{

    /**
     * Lists all Actor entities.
     *
     */
    public function indexAction()
    {
        // $config = array(
        //     'consumer_key' => $this->container->getParameter('consumer_key'),
        //     'consumer_secret' => $this->container->getParameter('consumer_secret'),
        //     'oauth_token' => $this->container->getParameter('oauth_token'),
        //     'oauth_token_secret' => $this->container->getParameter('oauth_token_secret'),
        //     'output_format' => 'object'
        // );

        // $tw = new TwitterOAuth($config);

        // $params = array(
        //     'screen_name' => 'unpetitlu',
        //     'count' => 5,
        //     'exclude_replies' => true
        // );

        // $tweets = $tw->get('statuses/user_timeline', $params);

        // foreach ($tweets as $tweet) {
        //     die(var_dump($tweet->text));
        // }

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TroiswaTestBundle:Actor')->findAll();

        return $this->render('TroiswaTestBundle:Actor:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Actor entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Actor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('actor_show', array('id' => $entity->getId())));
        }

        return $this->render('TroiswaTestBundle:Actor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Actor entity.
    *
    * @param Actor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Actor $entity)
    {
        $form = $this->createForm(new ActorType(), $entity, array(
            'action' => $this->generateUrl('actor_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Actor entity.
     *
     */
    public function newAction()
    {
        $entity = new Actor();
        $form   = $this->createCreateForm($entity);

        return $this->render('TroiswaTestBundle:Actor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Actor entity.
     * 
     */
    public function showAction(Actor $entity, Request $request)
    {
        //$request->setLocale('en');
        $em = $this->getDoctrine()->getManager();

        //$entity = $em->getRepository('TroiswaTestBundle:Actor')->find($id);

        //if (!$entity) {
            //throw $this->createNotFoundException('Unable to find Actor entity.');
        //}

        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('TroiswaTestBundle:Actor:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Actor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TroiswaTestBundle:Actor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Actor entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TroiswaTestBundle:Actor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Actor entity.
    *
    * @param Actor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Actor $entity)
    {
        $form = $this->createForm(new ActorType(), $entity, array(
            'action' => $this->generateUrl('actor_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Actor entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TroiswaTestBundle:Actor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Actor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('actor_edit', array('id' => $id)));
        }

        return $this->render('TroiswaTestBundle:Actor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Actor entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TroiswaTestBundle:Actor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Actor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('actor'));
    }

    /**
     * Creates a form to delete a Actor entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actor_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
