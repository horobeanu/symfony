<?php

namespace webCS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Admin controller.
 *
 * @Route("")
 */
class IndexController extends Controller
{
    /**
     * Admin dashboard.
     *
     * @Route("/", name="dashboard")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('webCSAdminBundle:Index:index.html.twig', 
                array(
                    'test' => 'dan',
                ));
    }
}
