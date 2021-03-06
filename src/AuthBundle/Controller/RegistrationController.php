<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AuthBundle\Controller;

use AuthBundle\Form\UserType;
use AuthBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of RegistrationController
 *
 * @author jvillalv
 */
class RegistrationController extends Controller {

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request) {

        // 1) build the form
        $user = new User();
        $user->setIsActive(false);
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password 
            $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            try {
                // 4) save the User!
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $message = \Swift_Message::newInstance()
                        ->setSubject('AZ MIS Sign Up confirmation')
                        ->setFrom('cs.operations.desk@autozone.com')
                        ->setTo($user->getEmail())
                        ->setBody(
                        $this->renderView(
                                // app/Resources/views/Emails/registration.html.twig
                                'AuthBundle:email:register.html.twig', array('name' => $user->getUsername())
                        ), 'text/html'
                        )

                ;
                $this->get('mailer')->send($message);

                return $this->redirectToRoute('home');
            } catch (\Doctrine\DBAL\ORMException $e) {
                $this->addFlash('error', $e->getMessage());
                return $this->redirect($this->getRequest()->headers->get('referer'));
            }
            catch (\Exception $e) {
                // flash msg
                $this->addFlash('error', $e->getMessage());

            }
        }

        return $this->render(
            'AuthBundle:signin:register.html.twig', array('form' => $form->createView())
        );
    }

}
