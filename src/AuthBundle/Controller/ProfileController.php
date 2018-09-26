<?php

namespace AuthBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AuthBundle\Form\ChangePasswordType;
use AuthBundle\Form\Model\ChangePassword;

class ProfileController extends Controller {

    /**
     * @Route("/profile", name="profile")
     */
    public function indexAction() {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            //retrieve user             
            $user = $this->get('security.token_storage')->getToken()->getUser();
            return $this->render('AuthBundle:profile:index.html.twig', array(
                        'user' => $user
            ));
        } else {
            throw $this->createAccessDeniedException();
        }

        return $this->render('AuthBundle:profile:index.html.twig', array());
    }

    /**
     * @Route("/profile/password", name="password")
     */
    public function passwordAction(Request $request) {
        
        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(ChangePasswordType::class, $changePasswordModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();            
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $changePasswordModel->getNewPassword());
            $user->setPassword($encoded);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // perform some action,
            // such as encoding with MessageDigestPasswordEncoder and persist
            return $this->redirectToRoute('home');
        }

        return $this->render('AuthBundle:profile:update.html.twig', array('form' => $form->createView()
        ));
    }

}
