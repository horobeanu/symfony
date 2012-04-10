<?php

namespace webCS\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use webCS\AdminBundle\Entity\Cms;

/**
 * CMS pages. 
 */
class CmsController extends Controller
{
    
    /**
     * About us.
     *
     * @Route("/about", name="about")
     * @Template()
     */
    public function aboutAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('webCSAdminBundle:Cms')->findOneByName('About us');
        
        return $this->render('webCSFrontendBundle:Cms:cms.html.twig', array(
            'cms' => $entity->getDescription(),
            'pageTitle' => $entity->getName(),
        ));
    }
    
    /**
     * FAQ.
     *
     * @Route("/faq", name="faq")
     * @Template()
     */
    public function faqAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('webCSAdminBundle:Cms')->findOneByName('FAQ');
        
        return $this->render('webCSFrontendBundle:Cms:cms.html.twig', array(
            'cms' => $entity->getDescription(),
            'pageTitle' => $entity->getName(),
        ));
    }
    
}
