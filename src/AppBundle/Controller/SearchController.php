<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller {

	
		/**
	 * @Route("/pruebas", name="pruebas")
	 */
	public function pruebasAction(Request $request)
{
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

    return $this->render('default/pruebas.html.twig', [
        'form' => $form->createView(),
		'products' => $products
    ]);
}
	
	
	/**
	 * @Route("/search", name="search")
	 */
	public function searchAction(Request $request, $products) {
		
		
		dump($products);die;
		$a = $request->request->get('products')->getData();
		$data = $request->query->get('products');
		dump($a);dump($data);die;
		 $real_entity = $this->get('products')->get($products);
		return $this->render('default/search.html.twig', array(
			'products' => $data
		));
	}
	
	

}
