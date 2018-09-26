<?php

namespace AuthBundle\Controller;

use AuthBundle\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AuthBundle\Entity\User;
use AuthBundle\Entity\Role;
use StaffingBundle\Entity\Employee;
use StaffingBundle\Form\EmployeeType;

class UserController extends Controller {

    /**
     * @Route("user", name="user")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AuthBundle:User')->findAll();
        return $this->render('AuthBundle:User:index.html.twig', array(
                    'users' => $users
        ));
    }

    /**
     * @Route("user/edit/{id}", name="user_edit")
     */
    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AuthBundle:User')->find($id);
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('user'));
        }


        return $this->render('AuthBundle:User:edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("user/delete/{id}", name="user_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AuthBundle:User')->find($id);
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * @Route("/user/activation/{id}", name="user_activation")
     */
    public function activeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AuthBundle:User')->find($id);
        if ($user->getIsActive() == false) {
            $user->setIsActive(1);
        } else {
            $user->setIsActive(0);
        }
        $em->persist($user);
        $em->flush();
        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * @Route("/user/employee/{id}", name="user_employee")
     */
    public function profileAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $emprepo = $em->getRepository('StaffingBundle:Employee');
        $userrepo = $em->getRepository('AuthBundle:User');
        //check if profile exists
        $profile = $emprepo->findOneBy(
            array('user' => $id)
        );
        if ($profile) {
            return $this->redirect($this->generateUrl('user'));
        } else {
            $emp = new Employee();
            $form = $this->createForm(EmployeeType::class, $emp);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $emp->setUser($userrepo->find($id));
                $file = $emp->getProfilePicture();
                $filename = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('employee_directory'), $filename);
                $emp->setProfilePicture($filename);
                $em->persist($emp);
                $em->flush();
                return $this->redirect($this->generateUrl('employee'));
            }
            return $this->render('AuthBundle:User:profile.html.twig', array(
                    'form' => $form->createView(),
                    'userid' => $id
            ));
        }
    }
}
