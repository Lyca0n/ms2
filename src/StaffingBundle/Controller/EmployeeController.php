<?php

namespace StaffingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use StaffingBundle\Entity\Employee;
use StaffingBundle\Form\EmployeeType;
use StaffingBundle\Form\EmployeeEditType;

class EmployeeController extends Controller {

    /**
     * @Route("/employee", name="employee")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $personel = $em->getRepository('StaffingBundle:Employee')->findAll();
        return $this->render('StaffingBundle:employee:index.html.twig', array(
                    'staff' => $personel
        ));
    }

    /**
     * @Route("/employee/create", name="employee_create")
     */
    public function createAction(Request $request) {
        $emp = new Employee();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(EmployeeType::class, $emp, ["create"]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $emp->getProfilePicture();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('employee_directory'), $filename);
            $emp->setProfilePicture($filename);
            $em->persist($emp);
            $em->flush();

            return $this->redirect($this->generateUrl('employee'));
        }

        return $this->render('StaffingBundle:employee:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    /**
     * @Route("/employee/delete/{id}" , name="employee_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $employee = $em->getRepository('StaffingBundle:Employee')->find($id);
        $em->remove($employee);
        $em->flush();
        return $this->redirect($this->generateUrl('employee'));
    }

    /**
     * @Route("/employee/edit/{id}" , name="employee_edit")
     */
    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $employee = $em->getRepository('StaffingBundle:Employee')->find($id);
        $form = $this->createForm(EmployeeEditType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($employee);
            $em->flush();

            return $this->redirect($this->generateUrl('employee'));
        }

        return $this->render('StaffingBundle:employee:edit.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    /**
     * @Route("/employee/show/{id}" , name="employee_show")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $employee = $em->getRepository('StaffingBundle:Employee')->find($id);
        return $this->render('StaffingBundle:employee:show.html.twig', array(
                    'employee' => $employee
        ));
    }

}
