<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
/**
 * Description of SecurityController
 *
 * @author Nick
 */
class SecurityController extends Controller {
	//put your code here
	
	/**
	 * 
	 * @Route("/register", name="create_user")
	 */
	
	public function registerAction(Request $request)
	{
		
		$user = new User();
		
		$form = $this->createForm(\AppBundle\Form\UserType::class, $user);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
		}
		
		
		return $this->render('security/register.html.twig', array(
			'form' => $form->createView()
		));
	}
}
