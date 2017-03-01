<?php

namespace AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AuthBundle\Form\RoleType;
use AuthBundle\Entity\Role;


class RoleController extends Controller
{
    /**
     * @Route("role", name="role")
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $roles = $em->getRepository('AuthBundle:Role')->findAll();
        return $this->render('AuthBundle:Role:index.html.twig', array(
            'roles' => $roles
        ));
        
    }
    
    /**
     * @Route("role/create", name="role_create")
     */
    public function createAction(Request $request){
        
        $role = new Role();
        $em =  $this->getDoctrine()->getManager();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($role);
            $em->flush();
            
            return $this->redirect($this->generateUrl('role'));
        }
        
        return $this->render(
                        'AuthBundle:role:create.html.twig', array('form' => $form->createView())
        );        
    }
}
