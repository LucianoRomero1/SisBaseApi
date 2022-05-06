<?php

namespace AppBundle\Controller;

use AppBundle\Base\BaseController;
use AppBundle\Base\BaseService;
use AppBundle\Service\DefaultService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    private $homeService;
    private $baseService;

    public function __construct(DefaultService $homeService, BaseService $baseService){
        $this->homeService = $homeService;
        $this->baseService = $baseService;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->setBreadCrumbs();
        $entityManager = $this->getEm();
        
        return $this->render('default/index.html.twig');
    }

      /**
     * @Route("/example", name="example")
     */
    public function exampleAction(Request $request)
    {
        $this->setBreadCrumbs("Ejemplo", "example");
        $entityManager = $this->getEm();
        
        return $this->render('default/index.html.twig');
    }
}
