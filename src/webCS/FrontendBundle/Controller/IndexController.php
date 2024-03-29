<?php

namespace webCS\FrontendBundle\Controller;

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
     * Home page.
     *
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {   
        return $this->render('webCSFrontendBundle:Index:index.html.twig', array(
            'geo' => @geoip_record_by_name(@$_SERVER['REMOTE_ADDR']),
        ));
    }
}
