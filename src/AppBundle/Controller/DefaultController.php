<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

/**
	 * @Route("/", name="homepage")
	 */
	
	public function indexAction(Request $request) {
		$em = $this->getDoctrine()->getManager();
		
    $form = $this->createFormBuilder()
        ->add('name')
        ->getForm();

	$products = $em->getRepository('AppBundle:Product')->findAll();
    $form->handleRequest($request);

	if($request->isMethod('POST')) {
		if ($form->isSubmitted() && $form->isValid()) {
		$data = $form->get('name')->getData();

        $products = $em->getRepository('AppBundle:Product')->findByName($data);
		
		}
	}

    return $this->render('default/index.html.twig', [
        'form' => $form->createView(),
		'products' => $products
    ]);
		
	}
	



}
